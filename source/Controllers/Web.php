<?php

    namespace Source\Controllers;

    use stdClass;
    use Source\Models\User;

    class Web extends Controller {

        public function __construct($router) {

            parent::__construct($router);

            if(!empty($_SESSION["user"])) $this->router->redirect("app.home");
            
        }

        public function login(): void {

            $head = $this->seo->optimize("Logue no site |", site("desc"), $this->router->route("web.login"), routeImage("Login"))->render();

            echo $this->view->render("theme/public/login", [
                "head" => $head
            ]);

        }

        public function register(): void {

            $head = $this->seo->optimize("Crie sua conta | ".site("name"), site("desc"), $this->router->route("web.register"), routeImage("Register"))->render();

            $form_user = new \stdClass();
            $form_user->username = null;
            $form_user->email = null;
            $form_user->first_name = null;
            $form_user->last_name = null;

            echo $this->view->render("theme/public/register", [
                "head" => $head,
                "user" => $form_user
            ]);

        }

        public function forget(): void {

            $head = $this->seo->optimize("Recupere sua senha |", site("desc"), $this->router->route("web.login"), routeImage("Login"))->render();

            echo $this->view->render("theme/public/forget", [
                "head" => $head
            ]);

        }

        public function reset($data): void {


            if(empty($_SESSION["forget"])) {
                flash("error", "Informe seu Email para recuperar a senha!");
                $this->router->redirect("web.forget");
            }

            $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
            $forget = filter_var($data["forget"], FILTER_DEFAULT);

            

            if(!$email || !$forget) {

                flash("error", "Não foi possível continuar a recuperação, favor tentar novamente!");
                $this->router->redirect("web.forget");

            }

            $user = (new User())->find("Email = :e AND forget = :f", "e={$email}&f={$forget}")->fetch();

            if(!$user) {
                flash("error", "Não foi possível continuar a recuperação, favor tentar novamente!");
                $this->router->redirect("web.forget");
            }

            $head = $this->seo->optimize("Crie sua nova senha |", site("desc"), $this->router->route("web.reset"), routeImage("reset"))->render();

            echo $this->view->render("theme/public/reset", [
                "head" => $head
            ]);

        }

        public function verify($data): void {

            $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);

            

            if(!$email) {

                flash("error", "Não foi possível continuar a verificação, favor tentar novamente!");
                $this->router->redirect("web.login");

            }

            $user = (new User())->find("Email = :e", "e={$email}")->fetch();

            if(!$user) {
                flash("error", "Não foi possível continuar a verificação, favor tentar novamente!");
                $this->router->redirect("web.login");
            }

            if($user->Verified !== "false") {

                flash("error", "Este email já está verificado!");
                $this->router->redirect("web.login");
            }

            $head = $this->seo->optimize("Verifique sua conta |", site("desc"), $this->router->route("web.verify"), routeImage("verify"))->render();

            echo $this->view->render("theme/public/verify", [
                "head" => $head,
                "user" => $user 
            ]);

        }

        public function error($data): void {

            $error = filter_var($data["errcode"], FILTER_VALIDATE_INT);
            
            $head = $this->seo->optimize("Ooops {$error} | ".site("name"), site("desc"), $this->router->route("web.error", ["errcode" => $error]) , routeImage($error))->render();

            echo $this->view->render("theme/error/error", [
                "head" => $head,
                "error" => $error
            ]);

        }

    }