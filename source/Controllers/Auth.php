<?php

namespace Source\Controllers;

header('Content-type: application/json');
ini_set('default_charset', 'utf-8');

use Source\Models\CalendarEvent;
use Source\Models\User;
use Source\Models\Cardapio;
use Source\Models\Materia;
use Source\Models\Turma;
use Source\Support\Email;

use function PHPSTORM_META\sql_injection_subst;

class Auth extends Controller {



    public function __construct($router){
        
        parent::__construct($router);

    }

    public function login($data) : void {

        $data = filter_var_array($data);

        $username = filter_var($data["username"], FILTER_DEFAULT);
        $password = filter_var($data["password"], FILTER_DEFAULT);

        if(!$username || !$password) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informar dados válidos."
            ]);

            return;
        }

        $user = (new User())->find("Username = :u", "u={$username}")->fetch();



        if(!$user || !password_verify($password, $user->Password)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Dados incorretos."
            ]);

            return;
        }

        if($user->Verified !== "true") {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Verifique sua conta para acessar o site! Caso isso seja um erro, contate a secretaria da escola."
            ]);

            return;
        }

        $_SESSION["user"] = $user->Id;

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("App.home")
        ]);


    }

    public function register($data) :void {

        $data = filter_var_array($data);
        
        
        $username =  filter_var($data["username"], FILTER_DEFAULT);
        $email = filter_var($data["email"], FILTER_DEFAULT);
        $password = filter_var($data["password"], FILTER_DEFAULT);
        $confpassword = filter_var($data["confirmpassword"], FILTER_DEFAULT);
        $first_name = filter_var($data["first_name"], FILTER_DEFAULT);
        $grupo = filter_var($data["grupo"], FILTER_DEFAULT);
        $Turma = filter_var($data["turma"], FILTER_DEFAULT);
        $Materias = filter_var($data["materias"], FILTER_DEFAULT);


        if(in_array("", $data) || isEmptyArray($data)) {


            if (($grupo == 'Professor' && (empty($Materias) || empty($TurmasProf))) || ($grupo == 'Aluno' && empty($Turma))) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Preencha todos os campos!"
                ]);
    
                return;
            }

        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informe um email válido!"
            ]);

            return;
        }

        if(!$username) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Digite um usuário válido!"
            ]);

            return;
        }

        if(str_contains($username, ' ')) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O Username deve conter apenas uma palavra! Verifique se há espaços em branco..."
            ]);

            return;
        }

        if(strlen($username) > 20) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O Username deve conter no máximo 20 caracteres!"
            ]);

            return;
        }

        $check_user_username = (new User())->find('Username = :u', "u={$username}")->count();

        if($check_user_username) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Este usuário já está cadastrado!"
            ]);

            return;
        }

        $filter_name = filter_var($first_name, FILTER_SANITIZE_SPECIAL_CHARS);

        if(!$filter_name) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Digite um nome válido!"
            ]);

            return;
        }


        $check_numbers_name = preg_match('/\d/', $filter_name);

        if($check_numbers_name) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Digite um nome válido!"
            ]);

            return;
        }

        if(str_word_count($filter_name) < 2) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Digite o nome completo!"
            ]);

            return;

        }

        if(strlen($filter_name) > 65) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O Nome completo não teve ter mais de 65 caracteres!"
            ]);

            return;
        }

        $check_user_email_qtd = (new User())->find('Email = :e', "e={$email}")->count();

        if($check_user_email_qtd) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Este email já atingiu o número máximo de registros!"
            ]);

            return;

        }

        if($grupo != "Aluno" && $grupo != 'Admin' && $grupo != 'Owner' && $grupo != 'Professor') {


            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Grupo inválido!"
            ]);

            return;
        }

        if($grupo == 'Owner' && getSessionUser()->Grupo != 'Owner') {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Você não possui permissão para setar este grupo!"
            ]);

            return;
        }


        $check_passwords_equality = ($password === $confpassword);


        if(!$check_passwords_equality) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "As senhas não conferem!"
            ]);

            return;

        }

        $nameParts = explode(' ', $filter_name);
        $userNameExplode = explode(' ', $username);
        $first_name = $nameParts[0];
        $last_name = implode(' ', array_slice($nameParts, 1));

        $user = new User();
        $user->Username = $userNameExplode[0];
        $user->First_Name = $first_name;
        $user->Last_Name = $last_name;
        $user->Verified = "true";
        $user->Email = $email;
        $user->Grupo = $grupo;
        $user->Password = password_hash($password, PASSWORD_DEFAULT);
        $user->Avatar = defaultImage();

        if($grupo == 'Aluno') {
            $Turma = intval($Turma);
            if(!$Turma) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Turma inválida!"
                ]);
    
                return;
            }

            if(!(new Turma())->findById($Turma)) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Turma inválida!"
                ]);
    
                return;
            }
            
            $user->Turma = $Turma;
        } else if ($grupo == 'Professor') {


            $MateriasValidate = explode(",", trim($Materias));

            $MateriasValidate = array_map('intval', $MateriasValidate);

            foreach($MateriasValidate as $t) {
                $t = intval($t);
                if(!is_int($t)) {
                    echo $this->ajaxResponse("message", [
                        "type" => "error",
                        "message" => "Materia inválida!"
                    ]);
        
                    return;
                }

                $check = (new Materia())->findById($t);

                if(!$check) {
                    echo $this->ajaxResponse("message", [
                        "type" => "error",
                        "message" => "Materia inválida!"
                    ]);
        
                    return;
                }

                $user->MateriasTurma = implode(",", $MateriasValidate);
            }

        }

        if(!$user->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Erro ao cadastrar usuário!"
            ]);

            return;
        }
        
        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Usuário cadastrado com sucesso!"
        ]);

        

        //$this->autenticate($user);

    }

    public function editUser($data) : void {


        $username =  filter_var($data["Username"], FILTER_DEFAULT);
        $email = filter_var($data["Email"], FILTER_DEFAULT);
        $oldpass = filter_var($data["Password"], FILTER_DEFAULT);
        $newpass = filter_var($data["NewPassword"], FILTER_DEFAULT);
        $confpass = filter_var($data["ConfPassword"], FILTER_DEFAULT);
        $avatar = filter_var($data["Avatar"], FILTER_DEFAULT);

        if(!getSessionUser()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Houve um erro ao tentar processar os dados, favor atualizar a página!"
            ]);

            return;
        }

        $Id = getSessionUser()->Id;

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informe um email válido!"
            ]);

            return;
        }

        if(str_word_count($username) > 1 || str_word_count($username) < 1 || ctype_space($username)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O Username deve conter apenas uma palavra!"
            ]);

            return;
        }
        
        $check_user_username = (new User())->find('Username = :u AND Id <> :id', "u={$username} & id={$Id}")->count();


        if($check_user_username) {
           
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Já existe um Usuário cadastrado com esse Username!"
            ]);

            return;
        }


        $check_user_email_qtd = (new User())->find('Email = :e AND Id <> :id', "e={$email} & id={$Id}")->count();

        if($check_user_email_qtd) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Este email já atingiu o número máximo de registros!"
            ]);

            return;

        }

        if(empty($oldpass) || ctype_space($oldpass)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Digite a sua senha atual para salvar as alterações!"
            ]);

            return;
        }

        

        if(password_verify($oldpass, getSessionUser()->Password)) {
            $userNameExplode = explode(' ', $username);

            $user = (new User())->findById($Id);
            $user->Username = $userNameExplode[0];
            $user->Email = $email;

            if(!empty($avatar) && !ctype_space($avatar)) {

                    list($type, $avatar) = explode(';', $avatar);
                    list(, $avatar) = explode(',', $avatar);

                    $avatar = base64_decode($avatar);

                    $avatar_name = time().'.png';

                    file_put_contents('source/Client/Files/Images/Usuarios/'.$avatar_name, $avatar);

                    $user->Avatar = '/source/Client/Files/Images/Usuarios/'.$avatar_name;

            }
            


            if(!empty($newpass)) {
                if(ctype_space($newpass)) {
                    echo $this->ajaxResponse("message", [
                        "type" => "error",
                        "message" => "Digite uma senha válida!"
                    ]);
        
                    return;
                }

                if($newpass !== $confpass) {
                    echo $this->ajaxResponse("message", [
                        "type" => "error",
                        "message" => "As senhas não conferem!"
                    ]);
        
                    return;
                }

                $user->Password = password_hash($newpass, PASSWORD_DEFAULT);
            }

            if(!$user->save()) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Não foi possível salvar seus dados!"
                ]);
    
                return;
            }

            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Usuário salvo com sucesso!"
            ]);

            return;

        }

        echo $this->ajaxResponse("message", [
            "type" => "error",
            "message" => "Senha incorreta!"
        ]);

    }

    public function forget($data): void {


        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        if(!$email) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Informe um email válido para recuperar a senha!"
            ]);

            return;
        }

        $user = (new User())->find("email = :e", "e={$email}")->fetch();

        if(!$user) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Email não cadastrado em nosso banco de dados!"
            ]);

            return;
        }

        $user->forget = (md5(uniqid(rand(), true)));
        $user->save();

        $_SESSION["forget"] = $user->Id;

        $email = new Email();
        $email->add("Recupere sua senha | ".site("name"), $this->view->render("emails/recover", [
            "user" => $user,
            "link" => $this->router->route("web.reset", [
                "email" => $user->Email,
                "forget" => $user->forget
            ])
        ]), "{$user->Username}", "{$user->Email}")->send();

        flash("success", "Email de recuperação enviado!");

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.forget")
        ]);


    }

    public function reset($data): void {
        
        if(!empty($_SESSION["forget"]) || !$user = (new User())->findById($_SESSION["forget"])->fetch()) {

            flash("error", "Não foi possível recuperar! Verifique se você está na mesma sessão que solicitou a recuperação.");
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("web.forget")
            ]);

            return;


        }

        if(!empty($data["password"]) || !empty($data["password_re"])) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Informe e repita sua nova senha!"
            ]);

            return;


        }

        if($data["password"] !== $data["password_re"]) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "As senhas não conferem!"
            ]);

            return;


        }

        $user->Password = $data["password"];
        $user->forget = null;

        if($user->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $user->fail()->getMessage()
            ]);

            return;
        }

        unset($_SESSION["forget"]);

        flash("success", "Sua senha foi atualizada com sucesso!");

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.login")
        ]);

    }


    public function verify($data): void {


        $data = filter_var_array($data, FILTER_SANITIZE_SPECIAL_CHARS);

        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        if(!$email) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Informe um email válido para verificar!"
            ]);

            return;
        }


        $user = (new User())->find("email = :e", "e={$email}")->fetch();

        if(!$user) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Email não cadastrado em nosso banco de dados!"
            ]);

            return;
        }

        if($user->Verified !== "false") {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Email já verificado!"
            ]);

            return;
        }

        $verify_code = ($data["verify_code"] === $user->verify_code);

        if(!$verify_code) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Código de verificação incorreto!"
            ]);

            return;

        }

        $user->Verified = "true";
        $user->verify_code = null;
        $user->save();

        flash("success", "Verificado com sucesso!");

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.login")
        ]);


    }

    private function autenticate($user): void {

        if($user->Verified !== "false") {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Email já verificado!"
            ]);

            return;
        }

        $user->verify_code = sprintf("%05d", rand(0, 99999));
        $user->save();


        $email = new Email();
        $email->add("Verifique sua conta | ".site("name"), $this->view->render("emails/verify", [
            "user" => $user,
            "link" => $this->router->route("web.verify", [
                "email" => $user->Email
            ])
        ]), "{$user->Username}", "{$user->Email}")->send();

        flash("success", "Email de verificação enviado!");

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.login")
        ]);


    }

    public function calendarEvents() {
        $events = (new CalendarEvent)->find()->fetch(true);
        echo $this->ajaxResponse("message", [
            "events" => $events ? $events : null
        ]);

    }

    
    public function contact() {
        echo $this->ajaxResponse("message", [
            "type" => 'error',
            "message" => 'Contato em desenvolvimento...'
        ]);
        return;
    }

}