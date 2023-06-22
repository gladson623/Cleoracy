<?php

use Source\Controllers\Aluno;
use Source\Models\Cardapio;
use Source\Models\CalendarEvent;
use Source\Models\Materia;
use Source\Models\Turma;
use Source\Models\User;

function projetos(): array
{


    return ["tecnologia"];
}

function site(string $param = null): string
{

    if ($param && !empty(SITE[$param])) return SITE[$param];

    return SITE["root"];
}

function asset(string $path): string
{

    return SITE["root"] . "/views/assets/{$path}";
}

function flash(string $type = null, string $message = null): ?string
{
    if ($type && $message) {
        $_SESSION["flash"] = [
            "type" => $type,
            "message" => $message
        ];

        return null;
    }

    if (!empty($_SESSION["flash"]) && $flash = $_SESSION["flash"]) {
        unset($_SESSION["flash"]);

        $type = $flash["type"];
        $message = $flash["message"];

        return "<script> flash('$type', '$message') </script>";
    }

    return null;
}

function getTodayMenu(): string
{

    $date = date("Y-m-d");

    $cardapio = (new Cardapio)->find("Date = :d", "d={$date}")->fetch();

    if (!$cardapio) return "Nenhum cardápio cadastrado no dia de hoje";

    return "Nome do prato: " . $cardapio->Name . " <br><img src='/source/" . $cardapio->Image . "'><br> Descrição: " . $cardapio->Descricao . "";
}

function getContact(): string
{
    return "<strong>Telefone Secretaria -> (44) 9999999 </strong> <br> <br>
        <strong>Redes sociais ->  <a href='https://www.facebook.com/colegiocleoracy'><i class='fab fa-facebook fa-2x i'></i></a>
        <a href='https://www.instagram.com/colegiocleoracy/'><i class='fab fa-instagram fa-2x'></i></a></strong> <br> <br>
        <button id='btnContact' class='btnnn'>Contate-nos</button> <br> <br>";
}

function createEditProfile() : void {

    $user = getSessionUser();

    if($user) {

    }

    echo "<div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
    <div class='modal-content'>
    <div class='modal-header'>
    <h5 class='modal-title' id='editModalLabel' style='color: black;'>Editar Perfil</h5>
    <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
    <span aria-hidden='true'>&times;</span>
    </button>
    </div>
    
    <div class='modal-body'>

        <form id='counter' method='POST' action='".site("root")."/public/edit/User'>
            <input type='hidden' id='editId' name='Id' value='$user->Id'>
            <div class='form-group'>
                <label for='editU' style='color: black;'>Usuário</label>
                <input type='text' class='form-control' required name='Username' id='editU' value='$user->Username'>
            </div>
            <div class='form-group'>
                <label for='editEmail' style='color: black;'>Email</label>
                <input type='email' class='form-control' required name='Email' id='editEmail' value='$user->Email'>
            </div>
            <div class='form-group'>
                <label for='editOP' style='color: black;'>Senha Atual</label>
                <input type='password' class='form-control' required name='OldPassword' id='editOP' value=''>
            </div>
            <div class='form-group'>
                <label for='editNP' style='color: black;'>Senha nova</label>
                <input type='password' class='form-control' name='NewPassword' id='editNP' value=''>
            </div>
            <div class='form-group'>
                <label for='editCNP' style='color: black;'>Confirmar Senha nova</label>
                <input type='password' class='form-control' name='ConfNewPassword' id='editCNP' value=''>
            </div>
            <div class='form-group'>
            <p style='color: black;'>Avatar</p>
             <div class='custom-file'>
                <input type='file' name='Avatar' accept='.jpeg,.png' class='custom-file-input' id='editAvatar'>
                <label class='custom-file-label' id='filel' for='editAvatar'>Escolha um arquivo</label>
            </div>
            </div>
            <button  type='button' class='btn btn-primary' disabled id='previewBtn'>Visualizar</button>

    </div>

    <div class='modal-footer'>
        <button type='button' class='btn' onClick='location.href = \"".site("root")."/public/logoff\"' style='left: 1%; width: 20%; position: absolute;'><svg xmlns='http://www.w3.org/2000/svg' width='50' height='70' fill='currentColor' class='bi bi-door-open-fill' viewBox='0 0 16 16'>
        <path d='M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z'/>
      </svg> </button>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
        <input type='submit' class='btn btn-primary' value='Salvar Alterações' />
    </div>
    </form>";
}

function createTurmaTable() : void {
    $turmas = (new Turma())->find()->fetch(true);

    if($turmas) {

        foreach($turmas as $row) {
            $Id = $row["Id"];
            $Name = $row["Name"];
            $Description = $row["Description"];

            echo "<tr>
            <td>$Id</td>
            <td>$Name</td>
            <td>$Description</td>
            <td>
                <button type='button' style='margin-right: 5px' class='btn btn-primary' data-toggle='modal' data-target='#editModal$Id'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
            </svg></button>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteModal$Id'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
                <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
            </svg></button>
            </td>
            <div class='modal fade' id='editModal$Id' tabindex='-1' role='dialog' aria-labelledby='editModalLabel$Id' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
            <div class='modal-content'>
            <div class='modal-header'>
            <h5 class='modal-title' id='editModalLabel$Id'>Editar Turma $Id</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            
            <div class='modal-body'>

                <form id='counter$Id' method='POST' action='".site("root")."/admin/save/Turma'>
                    <div class='form-group'>
                        <input type='hidden' id='editId$Id' name='Id' value='$Id'>
                        <label for='editName$Id'>Nome</label>
                        <input type='text' class='form-control' name='Username' id='editName$Id' value='$Name'>
                    </div>
                    <div class='form-group'>
                        <label for='editDesc$Id'>Descrição</label>
                        <input type='text' class='form-control' name='First_Name' id='editDesc$Id' value='$Description'>
                    </div>

                </form>

            </div>

            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                <button type='button' class='btn btn-primary' onClick='saveTurma($Id, counter$Id)'>Salvar Alterações</button>
            </div>

            </div>
            </div>
            </div>

            <div class='modal fade' id='deleteModal$Id' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel$Id' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
            <div class='modal-content'>
            <div class='modal-header'>
            <h5 class='modal-title' id='deleteModalLabel$Id'>Excluir Turma $Name</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            <div class='modal-body'>
            <p>Deseja realmente excluir a Turma $Name?</p>
            </div>
            <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
            <button type='button' class='btn btn-danger' onClick='delTurma($Id)'>Excluir</button>
            </div>
            </div>
            </div>
            </div>
            </tr>";
        }

    } else {
        echo "<tr><td colspan='4'><strong>Nenhuma turma encontrada</strong></td></tr>";
    }
}
function createMateriasTable() : void {  
     $Materias = (new Materia())->find()->fetch(true);

    if($Materias) {

        foreach($Materias as $row) {
            $Id = $row["Id"];
            $Name = $row["Name"];
            $Turma = $row["Turma"];
            $TurmaOBJ = (new Turma())->findById($Turma);
            $TurmaName = ($TurmaOBJ) ? $TurmaOBJ->Name : "Turma Inválida";

            echo "<tr>
            <td>$Id</td>
            <td>$Name - $TurmaName</td>
            <td>
                <button type='button' style='margin-right: 5px' class='btn btn-primary' data-toggle='modal' data-target='#editModal$Id'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
            </svg></button>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteModal$Id'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
                <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
            </svg></button>
            </td>
            <div class='modal fade' id='editModal$Id' tabindex='-1' role='dialog' aria-labelledby='editModalLabel$Id' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
            <div class='modal-content'>
            <div class='modal-header'>
            <h5 class='modal-title' id='editModalLabel$Id'>Editar Materia $Id</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            
            <div class='modal-body'>

                <form id='counter$Id' method='POST' action='".site("root")."/admin/save/Materia'>
                    <div class='form-group'>
                        <input type='hidden' id='editId$Id' name='Id' value='$Id'>
                        <label for='editName$Id'>Nome</label>
                        <input type='text' class='form-control' name='Name' id='editName$Id' value='$Name'>
                    </div>
                    <div class='form-group'>
                        <label for='editTurma$Id'>Turma</label>
                        <select name='turma' class='form-control input_user' id='editTurma$Id'> 
                        
                    ";
                    $turmas = getTurmas();

                    if(!$turmas || empty($turmas)) {
                        echo "<option value='nada'>Nenhuma turma cadastrada!</option>";
                    } else {

                        foreach($turmas as $T) { 
                            $selected = ($Turma == $T["Id"]) ? 'selected' : '';
                            echo $Turma;
                            echo "<option $selected value='".$T['Id']."'>".$T['Name']."</option>";

                      }
                    }

                     

                echo "</select>
                    </div>

                </form>

            </div>

            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                <button type='button' class='btn btn-primary' onClick='saveMateria($Id, counter$Id)'>Salvar Alterações</button>
            </div>

            </div>
            </div>
            </div>

            <div class='modal fade' id='deleteModal$Id' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel$Id' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
            <div class='modal-content'>
            <div class='modal-header'>
            <h5 class='modal-title' id='deleteModalLabel$Id'>Excluir Materia $Name</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            <div class='modal-body'>
            <p>Deseja realmente excluir a Materia $Name?</p>
            </div>
            <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
            <button type='button' class='btn btn-danger' onClick='delMateria($Id)'>Excluir</button>
            </div>
            </div>
            </div>
            </div>
            </tr>";
        }

    } else {
        echo "<tr><td colspan='4'><strong>Nenhuma turma encontrada</strong></td></tr>";
    }
}


function htmlAlunoNotaByMateria(int $AlunoID, int $MateriaID) : string {
    $materia = (new Materia())->findById($MateriaID);
    if (!$materia) {
        return "<strong>Erro ao carregar matéria!</strong>";
    }

    $turma = (new Turma())->findById($materia->Turma);
    if (!$turma) {
        return "<strong>Erro ao carregar turma!</strong>";
    }

    $aluno = (new User())->findById($AlunoID);
    if (!$aluno || $aluno->Turma !== $turma->Id) {
        return "<strong>Erro ao carregar aluno!</strong>";
    }

    $NotaTurmaPeriodo = $aluno->NotaMateria;
    $objs = (empty($NotaTurmaPeriodo) || ctype_space($NotaTurmaPeriodo) || !isset($NotaTurmaPeriodo)) ? null : explode(';', $NotaTurmaPeriodo);
    $formattedObj = [];

    if (!is_array($objs)) {
        return "<strong>Erro ao carregar notas do aluno!</strong>";
    }

    foreach ($objs as $obj) {
        $carac = explode(',', $obj);
        $oNota = $carac[0];
        $oMateria = $carac[1];
        $oPeriodo = $carac[2];

        if ($oMateria == $MateriaID) {
            array_push($formattedObj, [
                'Nota' => $oNota,
                'Periodo' => $oPeriodo
            ]);
        }
    }

    if (empty($formattedObj) || isEmptyArray($formattedObj)) {
        return "<strong>Nenhuma nota encontrada!</strong>";
    }

    $first_grade = '';
    $second_grade = '';
    $third_grade = '';
    $fourth_grade = '';

    foreach ($formattedObj as $o) {


        $color = ($o["Nota"] > 60) ? 'style="color: blue;"' : 'style="color: red;"';

        if($o["Nota"] > 90) $color = 'style="color: green;"';

        if ($o["Periodo"] == 1) {

            $first_grade = '<div class="grade">1ª Nota: <span '.$color.' >' . $o["Nota"] . '</span></div><br>';
           
        } else if ($o["Periodo"] == 2) {
            $second_grade = '<div class="grade">2ª Nota: <span '.$color.' >' . $o["Nota"] . '</span></div><br>';
        } else if ($o["Periodo"] == 3) {
            $third_grade = '<div class="grade">3ª Nota: <span '.$color.' >' . $o["Nota"] . '</span></div><br>';
        } else if ($o["Periodo"] == 4) {
            $fourth_grade = '<div class="grade">4ª Nota: <span '.$color.' >' . $o["Nota"] . '</span></div><br>';
        }
    }

    $result = $first_grade . $second_grade . $third_grade . $fourth_grade;

    return (empty($result) || ctype_space($result)) ? '<strong>Erro ao renderizar notas encontradas!</strong>' : $result;
}


function createAlunoNotasTable() : void {  
    $Materias = getMaterias();

    if(!$Materias) {
        echo "<tr><td colspan='4'><strong>Nenhuma materia encontrada na sua turma, contate a secretaria!</strong></td></tr>";
    }

    $Aluno = getSessionUser();

    if(!$Aluno || !$Aluno->Turma) {
        echo "<tr><td colspan='4'><strong>Não foi possível carregar suas notas, contate a secretaria!</strong></td></tr>";
    }


    $MateriasByTurma = (new Materia())->find("Turma = :t", "t={$Aluno->Turma}")->fetch(true);


    if(!$MateriasByTurma) {
        echo "<tr><td colspan='4'><strong>Não foi possível carregar suas notas, contate a secretaria!</strong></td></tr>";
    }

       foreach($MateriasByTurma as $row) {
           $Id = $row["Id"];
           $Name = $row["Name"];



           $Professor = getProfessorByMateria($Id);
           $ProfName = ($Professor) ? $Professor->First_Name : "Professor inválido";
           echo "<tr>
           <td>$Name</td>
           <td>".ucfirst($ProfName)."</td>
           <td>
               <button type='button' style='margin-right: 5px' class='btn' style='background-color: white;' data-toggle='modal' data-target='#visModal$Id'><svg xmlns='http://www.w3.org/2000/svg' 
               height='1em' viewBox='0 0 576 512'><path d='M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0
                80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 
                1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z'/></svg></button>
           </td>
           </tr>
           <div class='modal fade' id='visModal$Id' tabindex='-1' role='dialog' aria-labelledby='visModalLabel$Id' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='visModalLabel$Id'>Visualizar nota - $Name</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            ".htmlAlunoNotaByMateria($Aluno->Id, $Id)."
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                        </div>
                    </div>
                </div>
            </div>";
           
       }

}

function getUsers() : Array|null {
    $users = (new User())->find()->fetch(true);

    if(!$users) return null;

    return $users;
}

function getAlunosByTurma(int $Id) : Array|null {

    $Alunos = (new User())->find("Turma = :t", "t={$Id}")->fetch(true);

    if(!$Alunos) return null;

    return $Alunos;

}

function createProfNotasTable() : void {
    $Materias = getMaterias();
    $Professor = getSessionUser();
    $ProfessorMat = $Professor->MateriasTurma;

    if($Materias && $Professor) {

        if($Professor->Grupo != 'Admin' && $Professor->Grupo != 'Owner') {

            if(!empty($ProfessorMat) && !ctype_space($ProfessorMat)) $ProfessorMat = explode(',', $ProfessorMat);

            if(!empty($ProfessorMat) && is_array($ProfessorMat)) {

                foreach($ProfessorMat as $matId) {

                    $row = (new Materia())->findById($matId);

                    if($row) {
                        $Id = $row->Id;
                        $Name = $row->Name;
                        $Turma = $row->Turma;
                        $TurmaOBJ = (new Turma())->findById($Turma);
                        $TurmaName = ($TurmaOBJ) ? $TurmaOBJ->Name : "Turma Inválida";
                        $alunos = getAlunosByTurma($Turma);
            
                        $all = [];
                        echo "<tr>
                        <td>$Name</td>
                        <td>$TurmaName</td>
            
                        <td>
                            <button type='button' style='margin-right: 5px' class='btn btn-primary' data-toggle='modal' data-target='#editModal$Id'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                        </svg></button>
            
                        </td>
                        <div class='modal fade' id='editModal$Id' tabindex='-1' role='dialog' aria-labelledby='editModalLabel$Id' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                        <h5 class='modal-title' id='editModalLabel$Id'>Editar Nota -> $Name - $TurmaName</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                        </div>
                        
                        <div class='modal-body'>
            
                            <form id='counter$Id' method='POST' action='".site("root")."/professor/save/Nota'>
            
                                <div class='form-group'>
                                    <label for='adivs$Id'>Aluno</label>
                                    <div name='Aluno'  id='adivs$Id'> </div>
                                    
                                ";
            
            
                                if ($alunos) {
                                    foreach ($alunos as $a) {
            
                                        array_push($all, [
                                            'value' => $a["Id"],
                                            'label' => $a["First_Name"] . ' ' . $a["Last_Name"]
                                        ]);
                                    }
                                }
            
                                echo "<script>
            
                                        VirtualSelect.init({
                                            ele: '#adivs$Id',
                                            options: " . json_encode($all) . ",
                                            placeholder: 'Selecione um aluno',
                                            search: true,
                                            searchGroup: false,
                                            searchByStartsWith: true,
                                            multiple: false,
                                            optionHeight: '40px',
                                            noOptionsText: 'Nada encontrado',
                                            noSearchResultsText: 'Nada encontrado',
                                            searchPlaceholderText: 'Busca...',
                                            optionsSelectedText: 'Opção selecionada',
                                            dropboxWidth: '100%',
                                            maxWidth: '740px',
                                            additionalClasses: 'form-control input_user'
                                        });
            
             
            
            
                                </script>";
                                
            
            
            
                            echo "
                                </div>
                                <div class='form-group'>
                                    <input type='hidden' id='editId$Id' name='Id' value='$Id'>
                                    <label for='editNota$Id'>Nota</label>
                                    <input type='number' class='form-control' name='Nota' id='editNota$Id'>
                                </div>
                                <div class='form-group'>
                                    <label for='editPeriodo$Id'>Período acadêmico</label>
                                    <select class='form-control' name='Periodo' id='editPeriodo$Id'> 
                                        <option value='1'> 1 </option>
                                        <option value='2'> 2 </option>
                                        <option value='3'> 3 </option>
                                        <option value='4'> 4 </option>
                                        
                                    </select>
                                </div>
                            </form>
            
                        </div>
            
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                            <button type='button' class='btn btn-primary' onClick='saveNota($Id, counter$Id)'>Salvar Alterações</button>
                        </div>
            
                        </div>
                        </div>
                        </div>
            
                        </tr>";
                    }

                }

            }
            return; 
        }

        foreach($Materias as $row) {
            $Id = $row["Id"];
            $Name = $row["Name"];
            $Turma = $row["Turma"];
            $TurmaOBJ = (new Turma())->findById($Turma);
            $TurmaName = ($TurmaOBJ) ? $TurmaOBJ->Name : "Turma Inválida";
            $alunos = getAlunosByTurma($Turma);

            $all = [];
            echo "<tr>
            <td>$Name</td>
            <td>$TurmaName</td>

            <td>
                <button type='button' style='margin-right: 5px' class='btn btn-primary' data-toggle='modal' data-target='#editModal$Id'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
            </svg></button>

            </td>
            <div class='modal fade' id='editModal$Id' tabindex='-1' role='dialog' aria-labelledby='editModalLabel$Id' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
            <div class='modal-content'>
            <div class='modal-header'>
            <h5 class='modal-title' id='editModalLabel$Id'>Editar Nota -> $Name - $TurmaName</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            
            <div class='modal-body'>

                <form id='counter$Id' method='POST' action='".site("root")."/professor/save/Nota'>

                    <div class='form-group'>
                        <label for='adivs$Id'>Turma</label>
                        <div name='Aluno'  id='adivs$Id'> </div>
                        
                    ";


                    if ($alunos) {
                        foreach ($alunos as $a) {

                            array_push($all, [
                                'value' => $a["Id"],
                                'label' => $a["First_Name"] . ' ' . $a["Last_Name"]
                            ]);
                        }
                    }

                    echo "<script>

                            VirtualSelect.init({
                                ele: '#adivs$Id',
                                options: " . json_encode($all) . ",
                                placeholder: 'Selecione um aluno',
                                search: true,
                                searchGroup: false,
                                searchByStartsWith: true,
                                multiple: false,
                                optionHeight: '40px',
                                noOptionsText: 'Nada encontrado',
                                noSearchResultsText: 'Nada encontrado',
                                searchPlaceholderText: 'Busca...',
                                optionsSelectedText: 'Opção selecionada',
                                dropboxWidth: '100%',
                                maxWidth: '740px',
                                additionalClasses: 'form-control input_user'
                            });

 


                    </script>";
                    



                echo "
                    </div>
                    <div class='form-group'>
                        <input type='hidden' id='editId$Id' name='Id' value='$Id'>
                        <label for='editNota$Id'>Nota</label>
                        <input type='number' class='form-control' name='Nota' id='editNota$Id'>
                    </div>
                    <div class='form-group'>
                        <label for='editPeriodo$Id'>Período acadêmico</label>
                        <select class='form-control' name='Periodo' id='editPeriodo$Id'> 
                            <option value='1'> 1 </option>
                            <option value='2'> 2 </option>
                            <option value='3'> 3 </option>
                            <option value='4'> 4 </option>
                            
                        </select>
                    </div>
                </form>

            </div>

            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                <button type='button' class='btn btn-primary' onClick='saveNota($Id, counter$Id)'>Salvar Alterações</button>
            </div>

            </div>
            </div>
            </div>

            </tr>";
        }

    } else {
        echo "<tr><td colspan='4'><strong>Nenhuma turma encontrada</strong></td></tr>";
    }
}

function createUsersTable() : void {

        $users = (new User())->find()->fetch(true);

        if ($users) {

          foreach ($users as $row) {
                $id = $row["Id"];
                $first_name = $row["First_Name"];
                $last_name = $row["Last_Name"];
                $username = $row["Username"];
                $email = $row["Email"];
                $grupo = $row["Grupo"];
                $avatar = $row["Avatar"];
                $turmas = $row["Turma"];
                $materias = $row["MateriasTurma"];

                echo "<tr>
                <td><img src='".site('root')."$avatar' style='width: 50px; height: 50px; border-radius: 50%;' /></td>
                <td>$id</td>
                <td>$first_name $last_name</td>
                <td>$email</td>
                <td>";
                if($grupo != 'Owner') {

                    if($grupo == 'Admin' && getSessionUser()->Grupo != 'Owner') {
                        echo "<button type='button' class='btn btn-danger' disabled>Conta administradora</button>";  

                    } else {

                        echo "<button type='button' style='margin-right: 5px' class='btn btn-primary' data-toggle='modal' data-target='#editModal$id'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                    </svg></button>
                        <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteModal$id'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                        <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
                        <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
                    </svg></button>";

                    }
                    echo "</td>
                    </tr>
                    <div class='modal fade' id='editModal$id' tabindex='-1' role='dialog' aria-labelledby='editModalLabel$id' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                    <h5 class='modal-title' id='editModalLabel$id'>Editar Usuário $id</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>
                    
                    <div class='modal-body'>

                        <form id='counter$id' method='POST' action='".site("root")."/admin/save/User'>
                            <div class='form-group'>
                                <input type='hidden' id='editId$id' name='Id' value='$id'>
                                <label for='editUsername$id'>Usuário</label>
                                <input type='text' class='form-control' name='Username' id='editUsername$id' value='$username'>
                            </div>
                            <div class='form-group'>
                                <label for='editFirstName$id'>Primeiro Nome</label>
                                <input type='text' class='form-control' name='First_Name' id='editFirstName$id' value='$first_name'>
                            </div>
                            <div class='form-group'>
                                <label for='editLastName$id'>Sobrenome</label>
                                <input type='text' class='form-control' name='Last_Name' id='editLastName$id' value='$last_name'>
                            </div>
                            <div class='form-group'>
                                <label for='editEmail$id'>Email</label>
                                <input type='email' class='form-control' name='Email' id='editEmail$id' value='$email'>
                            </div>
                            <div class='form-group'>
                                <label for='editGrupo$id'>Grupo</label>
                                <select type='text' class='form-control gsels' name='Grupo' id='editGrupo$id'>";
                                if($grupo == "Admin") {
                                    echo "<option value='Professor'>Professor</option>
                                    <option value='Admin' selected>Admin</option>
                                    <option value='Aluno'>Aluno</option>";
                                } elseif($grupo == "Professor") {
                                    echo "<option value='Professor' selected>Professor</option>
                                    <option value='Admin'>Admin</option>
                                    <option value='Aluno'>Aluno</option>";
                                } else {
                                    echo "<option value='Aluno' selected>Aluno</option>
                                    <option value='Admin'>Admin</option>
                                    <option value='Professor'>Professor</option>";
                                    
                                }

                                echo "</select>
                            </div>
                            <div class='form-group tdivs' id='tdivs'>
                                <label for='editTurma$id'>Turma</label>
                                <select class='form-control' name='Turma' id='editTurma$id'>";

                                $turmas = getTurmas();

                                if(!$turmas) {
                                    echo "<option value='nada'>Nenhuma turma cadastrada!</option>";
                                } else {
                                    

                                    foreach ($turmas as $Turma) {
                                        $turm = $row["Turma"];
                                        $selected = ($grupo == 'Aluno' && $turm == $Turma["Id"] ) ? 'selected' : '';
                                        echo "<option value='".$Turma["Id"]."' ".$selected.">".$Turma["Name"]."</option>";
                                    }
                                    
                                }

                                echo "</select>
                            </div>
                        </form>";
                                

                        echo "<label class='mlb' for='mdivs$id'>Materias</label>
                        <div class='form-group mdivs' id='mdivs$id'>
                            ";


                            $materias = getMaterias();

                            if(!$materias) {
                                echo "<option value='nada'>Nenhuma materia cadastrada!</option>";
                            } else {
                                
                                $setted = [];

                                foreach ($materias as $Materia) {
                                    $matcru = $row["MateriasTurma"];
                                    $matproce = explode(',', $matcru);
                                    foreach($matproce as $matId) {
                                        $mat = (new Materia())->findById(intval($matId));
                                        if($mat) {
                                            $selectedb = ($grupo == 'Professor' && $Materia["Id"] == $mat->Id) ? true : false;
                                            
                                            if($selectedb) array_push($setted, $matId);

                                        }
                                    }

                                }

                                echo "<script>  const timeouts$id = setTimeout(() => {
                                    
                                    VirtualSelect.init({
                                        ele: '#mdivs$id',
                                        options: optionsM,
                                        placeholder: 'Selecione as materias',
                                        search: true,
                                        searchGroup: false,
                                        searchByStartsWith: true,
                                        multiple: true,
                                        optionHeight: '40px',
                                        allOptionsSelectedText: 'Todos',
                                        
                                        noOptionsText: 'Nada encontrado',
                                        noSearchResultsTex: 'nada encontrado',
                                        selectAllText: 'Selecionar todos',
                                        searchPlaceholderText: 'Busca...', 
                                        optionsSelectedText: 'Opção selecionada',
                                        dropboxWidth: '100%',
                                        maxWidth: '740px',
                                        additionalClasses: 'form-control input_user'
                                    });
                                
                                
                                }, 500); </script>";

                                if(!empty($setted)) {
                                    $allString = implode(",", $setted);
                                    echo "<script>  const timeout$id = setTimeout(() => {
                                    
                                        const selectedValues = \"$allString\".split(',').map(value => value.trim());
                                        document.querySelector('#mdivs$id').setValue(selectedValues);
                                    
                                    
                                    }, 500); </script>";
                                }
                            }

                        echo "
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                        <button type='button' class='btn btn-primary' onClick='saveUser($id, counter$id)'>Salvar Alterações</button>
                    </div>

                    </div>
                    </div>
                    </div>

                    <div class='modal fade' id='deleteModal$id' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel$id' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                    <h5 class='modal-title' id='deleteModalLabel$id'>Excluir Usuário $username</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>
                    <div class='modal-body'>
                    <p>Deseja realmente excluir o usuário $username?</p>
                    </div>
                    <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <button type='button' class='btn btn-danger' onClick='delUser($id)'>Excluir</button>
                    </div>
                    </div>
                    </div>
                    </div>";
                } else {

                    echo "<button type='button' class='btn btn-danger' disabled>Conta administradora</button>  
                    </td>
                    </tr>";
                }
          }
        } else {
          echo "<tr><td colspan='4'>Nenhum usuário encontrado</td></tr>";
        }

}

function getProfessorByMateria(int $Id) : User|Null {
    
    $professor = null;

    $users = (new User())->find()->fetch(true);

    if(!$users) return null;

    foreach($users as $user) {
        $MateriasTurmaFromDB = $user["MateriasTurma"];
        $MateriasFormated = explode(',', $MateriasTurmaFromDB);

        if($MateriasFormated && !empty($MateriasFormated)) {
            foreach($MateriasFormated as $mat) {

                if(intval($mat) == $Id) {
                    $professor = (new User())->findById($user["Id"]);
                }

            }
        }


    }

    return $professor;


}

function defaultImage() : string {
    return "/source/Client/Files/Images/Usuarios/perfil.jpeg";
}

function isEmptyArray(array $arr) : bool {
    
    $result = false;
    
    foreach($arr as $in) {

        if(ctype_space($in)) $result = true;


    }

    return $result;
}

function getGallery(): string
{
    return "<strong>[Sem fotos]</strong> <br> <br>";
}

function routeImage(string $imageUrl): string
{

    return "https://via.placeholder.com/1200x628/0984e3/FFFFFF?text={$imageUrl}";
}

function escape_mimic($inp)
{
    if (is_array($inp)) return array_map(__METHOD__, $inp);

    if (!empty($inp) && is_string($inp)) return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);

    return $inp;
}

function getSessionUser() : User|null {


    if(!isset($_SESSION["user"])) return null;

    return (new User())->findById($_SESSION["user"]);

}

function getTurmas() : array|Turma|null {

    $Turmas = (new Turma())->find()->fetch(true);

    if(!$Turmas) return null;

    return $Turmas;

}

function getMaterias() : array|Materia|null {

    $Materias = (new Materia())->find()->fetch(true);

    if(!$Materias) return null;

    return $Materias;

}

function validate_string(string $string): bool
{

    $caracteresProibidos = array(
        ' ', // Espaço em branco
        '@', // Símbolo de arroba
        '#', // Símbolo de hashtag
        '$', // Símbolo de cifrão
        '%', // Símbolo de porcentagem
        '&', // Símbolo de e comercial
        '*', // Asterisco
        '!', // Ponto de exclamação
        ';', // Ponto e vírgula
        '=', // Símbolo de igual
        '<', // Menor que
        '>', // Maior que
        '/', // Barra
        '\\', // Barra invertida
        '|', // Pipe
        '(', // Parêntese esquerdo
        ')', // Parêntese direito
        '{', // Chave esquerda
        '}', // Chave direita
        '[', // Colchete esquerdo
        ']', // Colchete direito
        '`', // Acento grave
        '~'  // Tilde
    );

    foreach ($caracteresProibidos as $char) {

        if (strpos($string, $char)) return false;
    }


    return true;
}

function is_valid_name_string(string $string): bool
{

    if ($string != filter_var($string, FILTER_SANITIZE_FULL_SPECIAL_CHARS)) return false;

    if (!validate_string($string)) return false;

    return true;
}
