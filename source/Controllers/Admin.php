<?php

    namespace Source\Controllers;

    use Source\Models\User;
    use stdClass;

    class Admin extends Controller {

        protected $user;

        public function __construct($router) {

            parent::__construct($router);


            
            if(empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])) {
                unset($_SESSION["user"]);
                flash("error", "Acesso negado! Por favor logue-se.");
    
                $this->router->redirect("web.login");
        
            }

            

            if($this->user->Grupo !== "Admin" && $this->user->Grupo !== "Owner") {
                flash("error", "Acesso negado! Usuário sem permissão.");
    
                $this->router->redirect("web.login");
            }

            
        }

        public function dashboard(): void {
            $head = $this->seo->optimize("Tela de admin | ".site("name"), site("desc"), $this->router->route("admin.dashboard"), routeImage("Conta de admin"))->render();
        
        
            echo $this->view->render("theme/admin/dashboard", [
                "head" => $head,
                "user" => $this->user
            ]);
        }

        public function registerTurmas(): void {
            $head = $this->seo->optimize("Tela de admin | ".site("name"), site("desc"), $this->router->route("admin.registerTurmas"), routeImage("Conta de admin"))->render();
        
        
            echo $this->view->render("theme/admin/registerTurma", [
                "head" => $head,
                "user" => $this->user
            ]);
        }

        public function registerMaterias(): void {
            $head = $this->seo->optimize("Tela de admin | ".site("name"), site("desc"), $this->router->route("admin.registerMaterias"), routeImage("Conta de admin"))->render();
        
        
            echo $this->view->render("theme/admin/registerMaterias", [
                "head" => $head,
                "user" => $this->user
            ]);
        }

        public function turmas(): void {
            $head = $this->seo->optimize("Tela de admin | ".site("name"), site("desc"), $this->router->route("admin.turmas"), routeImage("Conta de admin"))->render();
        
        
            echo $this->view->render("theme/admin/turmas", [
                "head" => $head,
                "user" => $this->user
            ]);
        }

        public function materias(): void {
            $head = $this->seo->optimize("Tela de admin | ".site("name"), site("desc"), $this->router->route("admin.materias"), routeImage("Conta de admin"))->render();
        
        
            echo $this->view->render("theme/admin/materias", [
                "head" => $head,
                "user" => $this->user
            ]);
        }



        public function cardapio(): void {
            $head = $this->seo->optimize("Tela de admin | ".site("name"), site("desc"), $this->router->route("admin.cardapio"), routeImage("Conta de admin"))->render();
        
        
            echo $this->view->render("theme/admin/cardapio", [
                "head" => $head,
                "user" => $this->user
            ]);
        }

        public function calendario(): void {
            $head = $this->seo->optimize("Tela de admin | ".site("name"), site("desc"), $this->router->route("admin.calendario"), routeImage("Conta de admin"))->render();
        
        
            echo $this->view->render("theme/admin/calendario", [
                "head" => $head,
                "user" => $this->user
            ]);
        }

        public function register(): void {
            $head = $this->seo->optimize("Tela de admin | ".site("name"), site("desc"), $this->router->route("admin.register"), routeImage("Conta de admin"))->render();
        
        
            echo $this->view->render("theme/admin/register", [
                "head" => $head,
                "user" => $this->user
            ]);
        }

        public function users(): void {
            $head = $this->seo->optimize("Tela de admin | ".site("name"), site("desc"), $this->router->route("admin.users"), routeImage("Conta de admin"))->render();
        
        
            echo $this->view->render("theme/admin/usuarios", [
                "head" => $head,
                "user" => $this->user
            ]);
        }

    }