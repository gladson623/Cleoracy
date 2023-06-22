<?php

namespace Source\Controllers;

use DateInterval;
use DateTime;
use Source\Models\CalendarEvent;
use Source\Models\Cardapio;
use Source\Models\User;
use Source\Models\Turma;
use Source\Models\Horario;
use Source\Models\Materia;

class ProfAuth extends Controller
{


    public function __construct($router)
    {

        parent::__construct($router);
    }

    public function saveNota($data) : void {

        $data = json_decode(file_get_contents('php://input'));
        $Aluno =  filter_var($data->Aluno, FILTER_DEFAULT);
        $Id = filter_var($data->Id, FILTER_DEFAULT);
        $Nota = filter_var($data->Nota, FILTER_DEFAULT);
        $Periodo = filter_var($data->Periodo, FILTER_DEFAULT);

        

        foreach($data as $value) {
            if($value != $Id && (empty($value) || ctype_space($value))) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Preencha todos os campos!"
                ]);
    
                return;
            }
        }



        $AlunoOBJ = (new User())->findById($Aluno);

        if(!$AlunoOBJ) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Aluno inexistente ou não cadastrado nessa turma!"
            ]);

            return;
        }

        
        if($AlunoOBJ->Grupo != 'Aluno') {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Este usuário não é um aluno!"
            ]);

            return;
        }

        
        $materia = (new Materia())->findById(intval($Id));


        if(!$materia) {
            
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Materia não encontrada!"
            ]);

            return;
        }

        
        if($materia->Turma != $AlunoOBJ->Turma) {
            
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Turma da matéria e aluno não correspondem!"
            ]);

            return;
        }

        if(!$Nota || (intval($Nota) < 0 || intval($Nota) > 100)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Nota inválida!"
            ]);

            return;
        }

        if(!$Periodo || (intval($Periodo) < 1 || intval($Periodo) > 4)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Período inválido!"
            ]);

            return;
        }

        $toSave = $AlunoOBJ->NotaMateria;

        if($toSave != null && !empty($toSave) && !ctype_space($toSave)) {

            $toSave .=  ';'.intval($Nota).','.$materia->Id.','.intval($Periodo);

        }  else {
            $toSave = intval($Nota).','.$materia->Id.','.intval($Periodo);
        }

        $AlunoOBJ->NotaMateria = $toSave;

        if(!$AlunoOBJ->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Erro ao salvar nota do aluno!"
            ]);

            return;
        }
        

        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Nota salva com sucesso!"
        ]);
    }

}