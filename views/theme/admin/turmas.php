<!DOCTYPE html>
<html>
<head>
    <title>Dashboard de Administrador</title>
    <!-- Adicione os links de referência ao Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <!-- Barra de navegação -->
    <div class="login_form_callback"> <?php flash();?></div>
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
    <?= flash(); ?>
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
                        <a class="nav-link" href="#">Gerenciar Turmas</a>
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
            <h5 class="card-title">Gerenciar Turmas</h5> <a href="<?=$router->route("admin.registerTurmas")?>" class="btn btn-primary"><i class="fas fa-plus"></i></a>

            <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php createTurmaTable();?>
      </tbody>
    </table>
  </div>
            <br>
        </div>



</body>
</html>
<style>

    #vis {
        
        font-family: cursive;
        font-size: xx-large;

    }

    #vis img {

        height: 200px;
        width: 200px;
        border-radius: 50%;

    }

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

$(function () {

  if($(".gsels").val() != "Aluno") { $("#tdivs").hide(); }

  $(".gsels").on('change', function() {

      val = $(this).val();

      if(val == "Aluno")   {
            $("#tdivs").show(); 
      } else {
          $("#tdivs").hide(); 
      }

  });

});

function saveTurma(UserId, FormId) {
    
  var action = $(FormId).attr('action');

  const form = document.querySelector('#counter1');


    
    var data = {"Name" : document.querySelector("#editName" + UserId).value, 
    "Description" :document.querySelector("#editDesc" + UserId).value,
    "Id" : UserId};

  $.ajax({
    url: action,
    data: JSON.stringify(data),
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
          confirmButtonText: 'OK'

        }).then(() => {
            if(su.message.type === 'success') location.reload();

        });


        return;
      }

      if (su.redirect) {
        location.href = su.redirect.url;
      }
    }
  });
}

function delTurma(UserId) {
  
      
    var data = {"Id" : UserId};
  
    $.ajax({
      url: "<?= site("root")."/admin/delete/Turma" ?>",
      data: JSON.stringify(data),
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
            confirmButtonText: 'OK'
  
          }).then(() => {
  
            if(su.message.type === 'success') location.reload();
  
          });
  
          return;
        }
  
        if (su.redirect) {
          location.href = su.redirect.url;
        }
      }
    });
  }


 

function flash(type, message) {

    Swal.fire({
    icon: type === 'error' ? 'error' : 'success',
    title: type === 'error' ? 'Erro' : 'Sucesso',
    text: message
    });

}





  
</script>
