<?php

namespace Source\Controllers;
use Source\Models\User;
use stdClass;

class App extends Controller {

    protected $user;

    public function __construct($router) {
        
        parent::__construct($router);

        if(empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])) {
            unset($_SESSION["user"]);
            flash("error", "Acesso negado! Por favor logue-se.");

            $this->router->redirect("web.login");
    
        }

    }

    public function home(): void {
        $head = $this->seo->optimize("Bem vindo(a) {$this->user->Username} | ".site("name"), site("desc"), $this->router->route("app.home"), routeImage("Conta de {$this->user->Username}"))->render();
    
    
        echo $this->view->render("theme/app/home", [
            "head" => $head,
            "user" => $this->user
        ]);
    }

    public function gallery(): void {
        $head = $this->seo->optimize("Galeria | ".site("name"), site("desc"), $this->router->route("app.gallery"), routeImage("Galeria"))->render();
    
    
        echo $this->view->render("theme/app/gallery", [
            "head" => $head,
            "user" => $this->user
        ]);
    }

    public function cardapio(): void {
        $head = $this->seo->optimize("Cardapio | ".site("name"), site("desc"), $this->router->route("app.cardapio"), routeImage("Cardapio"))->render();
    
    
        echo $this->view->render("theme/app/cardapio", [
            "head" => $head,
            "user" => $this->user
        ]);
    }

    public function contact(): void {
        $head = $this->seo->optimize("Contato | ".site("name"), site("desc"), $this->router->route("app.contact"), routeImage("Contato"))->render();
    
    
        echo $this->view->render("theme/app/contact", [
            "head" => $head,
            "user" => $this->user
        ]);
    }

    public function projects($data = null): void {
        
            if($data == null) {
                flash("error", "Informe um projeto para acessar!");
                $this->router->redirect("web.login");

            }

            $project = filter_var($data["project"], FILTER_SANITIZE_SPECIAL_CHARS);


            if(!$project) {

                flash("error", "Projeto inválido!");
                $this->router->redirect("web.login");

            }


            if(!in_array(strtolower($project), projetos())) {
                
                flash("error", "Projeto inválido!");
                $this->router->redirect("web.login");

            }

            $head = $this->seo->optimize("Projeto $project |", site("desc"), $this->router->route("app.projects"), routeImage("Projetos"))->render();

            echo $this->view->render("theme/app/projects/$project", [
                "head" => $head
            ]);

    }

    public function logoff(): void {

        unset($_SESSION["user"]);

        $this->router->redirect("web.login");

    }

}