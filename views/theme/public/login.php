

<!DOCTYPE html>
        <html>
            
        <head>
        <meta charset="utf-8">
            <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
            <title>Login</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
            <link rel="stylesheet" href="views/assets/css/login.css">
            <link rel="stylesheet" href="views/assets/css/message.css">
            <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
            <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
            <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="views/assets/js/form.js"></script>
            <script src="views/assets/js/utils.js"></script>
        </head>
        <body>
            <div class="container h-100">
                <div class="login_form_callback"> <?=flash();?></div>
                <div class="d-flex justify-content-center h-100 login">
                    <div class="user_card">
                        <div class="d-flex justify-content-center">
                            <div class="brand_logo_container">
                                <img src="views/assets/images/logo.png" class="brand_logo" alt="Logo">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center form_container">
                            <form method="POST" action="<?= $router->route("auth.login")?>">
                                <input type="hidden" name="action" value="login">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="username" class="form-control input_user" required placeholder="Usuário">
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control input_pass" required placeholder="Senha">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Lembrar credenciais</label>
                                    </div>
                                </div>
                                    <div class="d-flex justify-content-center mt-3 login_container">
                                     <button type="submit" name="button" class="btn login_btn btn-primary">Entrar</button>
                                   </div>
                                   <div class="d-flex justify-content-center mt-3 login_container"></div>
                            </form>
                        </div>
                
                        <div class="mt-4">
                            <!--<div class="d-flex justify-content-center links">-->
                            <!--    Não tem uma conta? <a href="<?= $router->route("web.register")?>" class="ml-2">Cadastrar</a>-->
                            <!--</div>-->
                            <div class="d-flex justify-content-center links">
                                <a href="<?= $router->route("web.forget")?>">Esqueceu sua senha?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= flash()?>
        </body>
        </html>
