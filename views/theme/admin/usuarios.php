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
    <script src="http://localhost/cleoracy/views/theme/virtualSelect/virtual-select.min.js"></script>
    <link rel="stylesheet" href="http://localhost/cleoracy/views/theme/virtualSelect/virtual-select.min.css" />
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
                        <a class="nav-link" href="#">Gerenciar Usuários</a>
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
            <h5 class="card-title">Gerenciar Usuários</h5> <a href="<?=$router->route("admin.register")?>" class="btn btn-primary"><i class="fas fa-plus"></i></a>

            <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th>Avatar</th>
          <th>ID</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php createUsersTable();?>
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

$(document).ready(function() {
  $(".mdivs").hide();
  $(".mlb").hide();
  $(".tdivs").hide();

  $(".gsels").each(function() {
    var val = $(this).val();
    var modalId = $(this).closest(".modal").attr("id");

    if (val == "Aluno") {
      $("#" + modalId + " .tdivs").show();
      $("#" + modalId + " .mdivs").hide();
      $("#" + modalId + " .mlb").hide();
    } else if (val == "Professor") {
      $("#" + modalId + " .mdivs").show();
      $("#" + modalId + " .mlb").show();
      $("#" + modalId + " .tdivs").hide();
    } else {
      $("#" + modalId + " .mdivs").hide();
      $("#" + modalId + " .mlb").hide();
      $("#" + modalId + " .tdivs").hide();
    }
  });

  $(".gsels").on("change", function() {
    var val = $(this).val();
    var modalId = $(this).closest(".modal").attr("id");

    if (val == "Aluno") {
      $("#" + modalId + " .tdivs").show();
      $("#" + modalId + " .mdivs").hide();
      $("#" + modalId + " .mlb").hide();
    } else if (val == "Professor") {
      $("#" + modalId + " .mdivs").show();
      $("#" + modalId + " .mlb").show();
      $("#" + modalId + " .tdivs").hide();
    } else {
      $("#" + modalId + " .mdivs").hide();
      $("#" + modalId + " .mlb").hide();
      $("#" + modalId + " .tdivs").hide();
    }
  });
});





function saveUser(UserId, FormId) {
    
  var action = $(FormId).attr('action');



    
    var data = {"Username" : document.querySelector("#editUsername" + UserId).value, 
    "First_Name" :document.querySelector("#editFirstName" + UserId).value,
    "Last_Name" :document.querySelector("#editLastName" + UserId).value,
    "Email" :document.querySelector("#editEmail" + UserId).value,
    "Grupo" :document.querySelector("#editGrupo" + UserId).value,
    "Turma" :document.querySelector("#editTurma" + UserId).value,
    "Materias" : document.querySelector("#mdivs" + UserId).value,
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


        if (su.message.type === 'success') {
            


        }

        return;
      }

      if (su.redirect) {
        location.href = su.redirect.url;
      }
    }
  });
}

function delUser(UserId) {
  
      
    var data = {"Id" : UserId};
  
    $.ajax({
      url: "<?= site("root")."/admin/delete/User" ?>",
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


    const materias = JSON.parse('<?php echo json_encode(getMaterias()); ?>');
    const turmas = JSON.parse('<?php echo json_encode(getTurmas()); ?>');
    optionsM = [];
    
    materias.forEach(materia => {
        let encontrado = turmas.find(objeto => objeto.Id === materia.Turma)
        optionsM.push({
            value: materia.Id,
            label:  (encontrado ? encontrado.Name : 'Turma inválida')   + " - " + materia.Name
        });
    });





  
</script>
