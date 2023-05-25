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
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gerenciar Cardapio do dia</a>
                    </li>
                </ul>
            </div>
            
            <!-- Conteúdo -->
            <div class="col-md-9 content">
                <h1>Dashboard de Administrador</h1>
                <div class="card">
        <div class="card-body">
            <h5 class="card-title">Alterar Cardápio</h5>
            <form method="post" action="<?= $router->route("auth.saveCardapio")?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="prato">Nome do Prato</label>
                    <input type="text" name="dishName" class="form-control" id="prato">
                </div>                   
                <div class="form-group">
                    <label for="imagem">Imagem do Prato</label>
                    <input type="file" name="dishImage" class="form-control-file" id="imagem">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
            <br>
            <button class="btn btn-primary" id="btnModal">Visualizar</button>
        </div>

        <div class="modal" id="vismodal">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- Conteúdo do modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Cardápio do dia - Visualização</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p><?=getTodayMenu();?></p>
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
 $(function () {
    $("form").submit(function (e) {
      e.preventDefault();
  
      var form = $(this);
      var action = form.attr("action");
      var data = new FormData(this);
  
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
        },
        contentType: false,
        processData: false
      });
    });
  });

function flash(type, message) {

    Swal.fire({
    icon: type === 'error' ? 'error' : 'success',
    title: type === 'error' ? 'Erro' : 'Sucesso',
    text: message
    });

}

$(document).ready(function() {
    $('.dropdown-toggle').on('click', function() {
      var dropdownMenu = $(this).siblings('.dropdown-menu');
      $('.dropdown-menu').not(dropdownMenu).hide(); // Fecha outros dropdowns abertos
      dropdownMenu.toggle(); // Abre ou fecha o dropdown atual
    });
  });



// Obtém o elemento do botão e o modal
var btnModal = document.getElementById("btnModal");
var modal = document.getElementById("vismodal");
var closeButton = modal.querySelector(".close");

// Adiciona um manipulador de eventos ao botão para abrir o modal
btnModal.addEventListener("click", function() {
  modal.style.display = "block";
});

// Adiciona um manipulador de eventos ao botão de fechar do modal
closeButton.addEventListener("click", function() {
  modal.style.display = "none";
});

// Fecha o modal quando o usuário clica fora dele
window.addEventListener("click", function(event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
});




  
</script>
