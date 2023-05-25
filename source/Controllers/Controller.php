<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use CoffeeCode\Optimizer\Optimizer;
use League\Plates\Engine;

abstract class Controller {

    /** @var Engine */

    protected $view;

    /** @var Router */
    protected $router;

    /** @var Optimizer*/
    protected $seo;

    public function __construct($router) {
        $this->router = $router;
        $this->view = new Engine(dirname(__DIR__, 2)."/views");
        $this->view->addData(["router" => $this->router]);

        $this->seo = new Optimizer();
        
    }

    public function ajaxResponse(string $param, array $values): string {

        return json_encode([$param => $values]);

    }

}