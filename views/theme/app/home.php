<!DOCTYPE html>
      <html lang="pt-br">
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          
          <link rel="stylesheet" href="views/assets/css/projects/tecnologianaescola.css">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-fullscreen-plugin/1.1.5/jquery.fullscreen-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <script src="views/assets/js/form.js"></script>
        <script src="views/assets/js/utils.js"></script>
        <script src="views/assets/js/nav.js"></script>
          <title>Projeto Escola e Tecnologia</title>
      </head>
      <body>
      <header class="p-3 text-white">
        <div class="login_form_callback"> <?= flash();?></div>
          <div class="">
            <div class="d-flex flex-wrap">
        
            <ul class="nav ">
              <li><a href="<?=$router->route("app.logoff")?>" class="nav-link px-2 text-dark">Sair</a></li>
              <li class="nav-item dropdown text-white">
                <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Projetos
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="<?= $router->route("app.projects", ["project" => "tecnologia"])?>">Tecnologia nas escolas</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown text-white">
                <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Escola
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="<?= $router->route("app.contact")?>">Contato</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="<?= $router->route("app.cardapio")?>">Cardápio</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="<?= $router->route("app.gallery")?>">Galeria</a></li>
                </ul>
              </li>
              <li><a href="<?= $router->route("admin.dashboard")?>" class="nav-link px-2 text-white" >Admin</a></li>
            </ul>
          </div>
        </div>
      </header>

 
      </body>
      <footer id="footer" class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <div class="col-md-4 d-flex align-items-center">
            <a href="#" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1" style="margin-right: 20px;">
                  <img src="views/assets/images/logo.png" width="35" height="35" class="bi" viewBox="0 0 16 16">
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Colégio Cleoracy Aparecida Gil</span>
          </div>     
          <div class="col-md-6 text-center">
              <a href="https://www.facebook.com/colegiocleoracy" target="_blank">
                <i class="fab fa-facebook fa-2x mx-3"></i>
              </a>
              <a href="https://www.instagram.com/colegiocleoracy/" target="_blank">
                <i class="fab fa-instagram fa-2x mx-3"></i>
              </a>
            </div>           
        </footer>
      </html>
