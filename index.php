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
    $router->post("/contact", "Auth:contact", "auth.contact");
    
    $router->post("/calendarEvents", "Auth:calendarEvents", "auth.calendarEvents");

    $router->group("/public");
    $router->get("/", "App:home", "app.home");
    $router->get("/galeria", "App:gallery", "app.gallery");
    $router->get("/contato", "App:contact", "app.contact");
    $router->get("/cardapio", "App:cardapio", "app.cardapio");
    $router->get("/calendario", "App:calendario", "app.calendario");
    $router->get("/projetos/{project}", "App:projects", "app.projects");
    $router->get("/logoff", "App:logoff", "app.logoff");

    $router->group("/public");
    $router->post("/edit/User", "Auth:editUser", "auth.editUser");

    $router->group("/admin");
    $router->get("/", "Admin:dashboard", "admin.dashboard");
    $router->get("/cardapio", "Admin:cardapio", "admin.cardapio");
    $router->get("/calendario", "Admin:calendario", "admin.calendario");
    $router->get("/cadastrar", "Admin:register", "admin.register");
    $router->get("/usuarios", "Admin:users", "admin.users");
    $router->get("/turmas", "Admin:turmas", "admin.turmas");
    $router->get("/materias", "Admin:materias", "admin.materias");
    $router->get("/cadastrar/turmas", "Admin:registerTurmas", "admin.registerTurmas");
    $router->get("/cadastrar/materias", "Admin:registerMaterias", "admin.registerMaterias");

    $router->group("/admin");
    $router->post("/save/cardapio", "AdminAuth:saveCardapio", "auth.saveCardapio");
    $router->post("/delete/CalEvent", "AdminAuth:delCalEvent", "auth.delCalEvent");
    $router->post("/delete/User", "AdminAuth:delUser", "auth.delUser");
    $router->post("/save/User", "AdminAuth:saveUser", "auth.saveUser");
    $router->post("/save/CalEvent", "AdminAuth:saveCalEvent", "auth.saveCalEvent");
    $router->post("/register/Turma", "AdminAuth:registerTurma", "auth.registerTurma");
    $router->post("/register/Materia", "AdminAuth:registerMateria", "auth.registerMateria");
    $router->post("/save/Materia", "AdminAuth:saveMateria", "auth.saveMateria");
    $router->post("/delete/Materia", "AdminAuth:delMateria", "auth.delMateria");
    $router->post("/save/Turma", "AdminAuth:saveTurma", "auth.saveTurma");
    $router->post("/delete/Turma", "AdminAuth:delTurma", "auth.delTurma");

    $router->group("/professor");
    $router->get("/", "Professor:dashboard", "professor.dashboard");
    $router->get("/notas", "Professor:notas", "professor.notas");


    $router->group("/professor");
    $router->post("/save/Nota", "ProfAuth:saveNota", "auth.saveNota");


    $router->group("/aluno");
    $router->get("/", "Aluno:dashboard", "aluno.dashboard");
    $router->get("/notas", "Aluno:notas", "aluno.notas");

    $router->group("error");
    $router->get("/{errcode}", "Web:error", "web.error");

    $router->dispatch();
    if($router->error()) $router->redirect("web.error", ["errcode" => $router->error()]);

    ob_end_flush();