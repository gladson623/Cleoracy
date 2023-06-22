<!DOCTYPE html>
<html>
<head>
    <title>Dashboard de Administrador</title>
    <!-- Adicione os links de referência ao Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <div class="container-fluid">
        <div class="row">
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
            <h5 class="card-title">Cadastrar Usuário</h5>
            <form method="POST" action="<?= $router->route("auth.register")?>">
                <input type="hidden" name="action" value="register">
                <div class="input-group mb-2">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" value="<?= $user->username ?>" name="username" class="form-control input_user" required placeholder="Usuário">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-clipboard"></i></span>
                    </div>
                    <input type="text" value="<?= $user->first_name ?>" name="first_name" class="form-control input_user" required placeholder="Nome completo">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" value="<?= $user->email ?>" name="email" class="form-control input_user" required placeholder="Email">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-chair"></i></span>
                    </div>
                    <select name="grupo" id="groupD" class="form-control input_user" required> <option value="Aluno">Aluno</option> <option value="Professor" selected>Professor</option> <option value="Admin">Admin</option> </select>
                </div>
                <div class="input-group mb-2" id="tdivs">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-chair"></i></span>
                    </div>
                    <select name="turma" class="form-control input_user" id='Turma'> 
                        
                    <?php
                    $turmas = getTurmas();

                    if(!$turmas || empty($turmas)) {
                        echo "<option value='nada'>Nenhuma turma cadastrada!</option>";
                    } else {

                        foreach($turmas as $Turma) { ?>
                            <option value="<?=$Turma["Id"]?>"><?=$Turma["Name"]?></option>"

                   <?php     }
                    }

                     ?>

                </select>

                </div>
                <div class="input-group mb-2 tpdivs">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-chair"></i></span>
                    </div>
                    <div name="materias"  id='Materias'> 
                        


                </div>

                </div>
                <div class="input-group mb-2">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" name="password" class="form-control input_pass" required placeholder="Senha">
                </div>
                <div class="input-group mb-2">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" name="confirmpassword" class="form-control input_pass" required placeholder="Confirmar senha">
                </div>

                <div class="d-flex justify-content-center mt-3 login_container">
                    <button type="submit" name="button" class="btn login_btn btn-primary">Cadastrar</button>
                </div>
            </form>
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

        .box {
      position: relative;
      border: 1px solid;
      transition-property: common;
      border-radius: md;
      transition-duration: normal;
      background-color: white;
      max-width: full;
    }

    .box:hover {
      border-color: gray.300;
    }

    .box.showOptions {
      border-color: blue.500;
    }

    .flex {
      flex-wrap: nowrap;
      border-radius: md;
    }

    .flex.multi {
      max-width: 100%;
    }

    .flex.multi input {
      width: 60%;
    }

    .flex input {
      min-width: 150px;
    }

    .input-group {
      max-width: full;
    }

    .input {
      width: 100%;
    }

    .input-right-element {
      cursor: pointer;
    }

    .list-item {
      padding: 5px 0;
      color: gray.500;
      height: full;
      text-align: center;
      align-items: center;
      display: flex;
      font-size: sm;
    }
    </style>
<script>
 

 $(function () {

    if($("#groupD").val() != "Aluno") { $("#tdivs").hide(); } 
    if($("#groupD").val() != "Professor") { $(".tpdivs").hide(); } 

    $("#groupD").on('change', function() {

        val = $(this).val();

        if(val == "Aluno")   {
            $(".tpdivs").hide();
              $("#tdivs").show(); 
        } else if(val == "Professor") {
            $("#tdivs").hide(); 
            $(".tpdivs").show();
        } else {
            $("#tdivs").hide(); 
            $(".tpdivs").hide();
        }

    });

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

            if(su.message.type === 'success') {
                form.trigger('reset');  
            }

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




    VirtualSelect.init({
        ele: '#Materias',
        options: optionsM,
        placeholder: 'Selecione as materias',
        search: true,
        searchGroup: false,
        searchByStartsWith: true,
        multiple: true,
        optionHeight: '40px',
        allOptionsSelectedText: 'Todos',

        noOptionsText: 'Nada encontrado',
        noSearchResultsTex: 'nada encontrado',
        selectAllText: 'Selecionar todos',
        searchPlaceholderText: 'Busca...', 
        optionsSelectedText: 'Opção selecionada',
        dropboxWidth: '100%',
        maxWidth: '740px',
        additionalClasses: 'form-control input_user',


    });






  });

function flash(type, message) {

    Swal.fire({
    icon: type === 'error' ? 'error' : 'success',
    title: type === 'error' ? 'Erro' : 'Sucesso',
    text: message
    });

}



  
</script>
