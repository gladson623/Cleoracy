<?php

    ob_start();
    session_start();

    require __DIR__."/vendor/autoload.php";

    use CoffeeCode\Router\Router;

    $router = new Router(site());

    $router->namespace("Source\Controllers");
    //WEB

    $router->group(null);
    $router->get("/", "Web:login", "web.login");
    $router->get("/cadastrar", "Web:register", "web.register");
    $router->get("/recuperar", "Web:forget", "web.forget");
    $router->get("/senha/{email}/{forget}", "Web:reset", "web.reset");
    $router->get("/senha/{email}/{confirm}", "Web:reset", "web.reset");
    $router->get("/verificar/{email}", "Web:verify", "web.verify");
    

    $router->group(null);
    $router->post("/login", "Auth:login", "auth.login");
    $router->post("/register", "Auth:register", "auth.register");
    $router->post("/forget", "Auth:forget", "auth.forget");
    $router->post("/reset", "Auth:reset", "auth.reset");
    $router->post("/verify", "Auth:verify", "auth.verify");

    $router->group("/public");
    $router->get("/", "App:home", "app.home");
    $router->get("/galeria", "App:gallery", "app.gallery");
    $router->get("/contato", "App:contact", "app.contact");
    $router->get("/cardapio", "App:cardapio", "app.cardapio");
    $router->get("/projetos/{project}", "App:projects", "app.projects");
    $router->get("/logoff", "App:logoff", "app.logoff");

    $router->group("/admin");
    $router->get("/", "Admin:dashboard", "admin.dashboard");
    $router->get("/cardapio", "Admin:cardapio", "admin.cardapio");

    $router->group("/admin");
    $router->post("/save/cardapio", "AdminAuth:saveCardapio", "auth.saveCardapio");

    $router->group("error");
    $router->get("/{errcode}", "Web:error", "web.error");

    $router->dispatch();
    if($router->error()) $router->redirect("web.error", ["errcode" => $router->error()]);


    ob_end_flush();