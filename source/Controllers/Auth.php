<?php

namespace Source\Controllers;

use Source\Models\User;
use Source\Models\Cardapio;
use Source\Support\Email;

class Auth extends Controller {



    public function __construct($router){
        
        parent::__construct($router);

    }

    public function login($data) : void {

        $data = filter_var_array($data, FILTER_SANITIZE_SPECIAL_CHARS);

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

        $data = filter_var_array($data, FILTER_SANITIZE_SPECIAL_CHARS);

        if(in_array("", $data)) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos!"
            ]);

            return;

        }

        if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informe um email válido!"
            ]);

            return;
        }

        $check_user_username = (new User())->find('Username = :u', "u={$data["username"]}")->count();

        if($check_user_username) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Este usuário já está cadastrado!"
            ]);

            return;
        }

        $filter_name = filter_var($data["first_name"], FILTER_SANITIZE_SPECIAL_CHARS);

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
                "message" => "Digite seu nome completo!"
            ]);

            return;

        }

        $check_user_email_qtd = (new User())->find('Email = :e', "e={$data["email"]}")->count();

        if($check_user_email_qtd) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Este email já atingiu o número máximo de registros!"
            ]);

            return;

        }

        $check_passwords_equality = ($data["password"] === $data["confirmpassword"]);


        if(!$check_passwords_equality) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "As senhas não conferem!"
            ]);

            return;

        }

        $nameParts = explode(' ', $filter_name);

        $first_name = $nameParts[0];
        $last_name = implode(',', array_slice($nameParts, 0));

        $user = new User();
        $user->Username = $data["username"];
        $user->First_Name = $first_name;
        $user->Last_Name = $last_name;
        $user->Verified = "true";
        $user->Email = $data["email"];
        $user->Password = password_hash($data["password"], PASSWORD_DEFAULT);

        $user->save();

        flash("success", "Cadastrado com sucesso!");
        
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.login")
        ]);

        //$this->autenticate($user);

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

}