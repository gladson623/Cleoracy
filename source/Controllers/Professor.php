<?php

    namespace Source\Controllers;

    use Source\Models\User;
    use stdClass;

    class Professor extends Controller {

        protected $user;

        public function __construct($router) {

            parent::__construct($router);


            
            if(empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])) {
                unset($_SESSION["user"]);
                flash("error", "Acesso negado! Por favor logue-se.");
    
                $this->router->redirect("web.login");
        
            }

            

            if($this->user->Grupo !== "Professor" && $this->user->Grupo !== "Admin" && $this->user->Grupo !== "Owner") {
                flash("error", "Acesso negado! Usuário sem permissão.");
    
                $this->router->redirect("web.login");
            }

            
        }

        public function dashboard(): void {
            $head = $this->seo->optimize("Área do professor | ".site("name"), site("desc"), $this->router->route("professor.dashboard"), routeImage("Area do professor"))->render();
        
        
            echo $this->view->render("theme/professor/dashboard", [
                "head" => $head,
                "user" => $this->user
            ]);
        }

        public function notas(): void {
            $head = $this->seo->optimize("Área do professor | ".site("name"), site("desc"), $this->router->route("professor.notas"), routeImage("Area do professor"))->render();
        
        
            echo $this->view->render("theme/professor/notas", [
                "head" => $head,
                "user" => $this->user
            ]);
        }




    }