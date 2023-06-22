<?php

    namespace Source\Controllers;

use Source\Models\Turma;
use Source\Models\User;
    use stdClass;

    class Aluno extends Controller {

        protected $user;

        public function __construct($router) {

            parent::__construct($router);


            
            if(empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])) {
                unset($_SESSION["user"]);
                flash("error", "Acesso negado! Por favor logue-se.");
    
                $this->router->redirect("web.login");
        
            }

            

            if($this->user->Grupo !== "Aluno") {
                flash("error", "Acesso negado! Usuário sem permissão.");
    
                $this->router->redirect("web.login");
            }



            $check_turma = (new Turma())->findById($this->user->Turma);

            if(!$check_turma) {
                flash("error", "Erro ao tentar acessar dados de sua turma! Por favor contate a secretaria.");
    
                $this->router->redirect("web.login");
            }

            
        }

        public function dashboard(): void {
            $head = $this->seo->optimize("Área do aluno | ".site("name"), site("desc"), $this->router->route("aluno.dashboard"), routeImage("Area do aluno"))->render();
        
        
            echo $this->view->render("theme/aluno/dashboard", [
                "head" => $head,
                "user" => $this->user
            ]);
        }

        public function notas(): void {
            $head = $this->seo->optimize("Área do aluno | ".site("name"), site("desc"), $this->router->route("aluno.notas"), routeImage("Area do aluno"))->render();
        
        
            echo $this->view->render("theme/aluno/notas", [
                "head" => $head,
                "user" => $this->user
            ]);
        }



    }