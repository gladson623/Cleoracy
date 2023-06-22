<!DOCTYPE html>
<html>
<head>
    <title>Dashboard de Administrador</title>
    <!-- Adicione os links de referência ao Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <!-- Barra de navegação -->
    <div class="login_form_callback"> <?= flash();?></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Colégio Cleoracy - Secretaria</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=$router->route("app.home")?>">Início</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?=$router->route("admin.dashboard")?>">Administração</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$router->route("app.logoff")?>">Sair</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Conteúdo principal -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.cardapio")?>">Gerenciar Cardapio do dia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.calendario")?>">Gerenciar Calendário</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.users")?>">Gerenciar Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.turmas")?>">Gerenciar Turmas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.materias")?>">Gerenciar Materias</a>
                    </li>
                </ul>
            </div>
            
            <!-- Conteúdo -->
            <div class="col-md-9 content">
                <h1>Dashboard de Administrador</h1>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                        <h5 class="card-title">Gerenciar Cardapio do dia</h5>
                        <p class="card-text">Aqui você pode alterar o cardapio do dia.</p>
                        <a href="<?=$router->route("admin.cardapio")?>" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                        <h5 class="card-title">Gerenciar Calendário</h5>
                        <p class="card-text">Aqui você pode gerenciar o calendário e adicionar ou remover eventos.</p>
                        <a href="<?=$router->route("admin.calendario")?>" class="btn btn-primary">Acessar</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                        <h5 class="card-title">Gerenciar Usuários</h5>
                        <p class="card-text">Aqui você pode editar ou excluir um usuário.</p>
                        <a href="<?=$router->route("admin.users")?>" class="btn btn-primary">Acessar</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                        <h5 class="card-title">Gerenciar Turmas</h5>
                        <p class="card-text">Aqui você pode editar ou excluir uma turma.</p>
                        <a href="<?=$router->route("admin.turmas")?>" class="btn btn-primary">Acessar</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                        <h5 class="card-title">Gerenciar Materias</h5>
                        <p class="card-text">Aqui você pode editar ou excluir uma turma.</p>
                        <a href="<?=$router->route("admin.materias")?>" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<style>
        .navbar-brand {
            font-weight: bold;
        }

        .sidebar {
            background-color: #343a40;
            color: #fff;
            min-height: 100vh;
            padding-top: 15px;
        }

        .sidebar a {
            color: #fff;
            padding: 10px 20px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #1d2124;
            color: #fff;
            text-decoration: none;
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            margin-bottom: 20px;
        }

        .card {
            border-radius: 10px;
        }

        .card-title {
            font-weight: bold;
        }
    </style>
<script>
function flash(type, message) {

Swal.fire({
icon: type === 'error' ? 'error' : 'success',
title: type === 'error' ? 'Erro' : 'Sucesso',
text: message
});

}





  $(function () {
    $("form").submit(function (e) {
      e.preventDefault();
  
      var form = $(this);
      var action = form.attr("action");
      var data = form.serialize();
  
      $.ajax({
        url: action,
        data: data,
        type: "post",
        dataType: "json",
        beforeSend: function () {
          swal.showLoading();
          
        },
        success: function (su) {
          Swal.close();
  
          if (su.message) {
            Swal.fire({
              icon: su.message.type === 'error' ? 'error' : 'success',
              title: su.message.type === 'error' ? 'Erro' : 'Sucesso',
              text: su.message.message,
            });
            return;
          }
  
          if (su.redirect) {
            location.href = su.redirect.url;
          }
        }
      });
    });
  });

  
</script>
