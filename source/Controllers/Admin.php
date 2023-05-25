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

            

            if($this->user->Grupo !== "admin") {
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

        public function cardapio(): void {
            $head = $this->seo->optimize("Tela de admin | ".site("name"), site("desc"), $this->router->route("admin.cardapio"), routeImage("Conta de admin"))->render();
        
        
            echo $this->view->render("theme/admin/cardapio", [
                "head" => $head,
                "user" => $this->user
            ]);
        }

    }