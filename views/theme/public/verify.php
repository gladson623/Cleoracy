<!DOCTYPE html>
        <html>
            
        <head>
            <title>Verificar</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

            <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
            <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        </head>
        <body>
            <div class="container h-100">
                <div class="login_form_callback"> <?=flash();?></div>
                <div class="d-flex justify-content-center h-100" style="position: absolute;">
                    <div class="user_card">
                    <div class="d-flex justify-content-center">
                            <div class="brand_logo_container">
                                <img src='https://www.pciconcursos.com.br/s/b9cbb1e6654fbd8e6360ec492a5a95ff.jpg' class="brand_logo" alt="Logo">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center form_container">
                            <form method="POST" action="<?= $router->route("auth.verify")?>">
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                                    </div>
                                    <input type="text" name="verify_code" class="form-control input_user" required placeholder="Código de verificação">
                                    <input type="hidden" name="email" value="<?= $user->Email; ?>">
                                </div>

                                <div class="d-flex justify-content-center mt-3 login_container">
                                     <button type="submit" name="button" class="btn login_btn btn-primary">Verificar</button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="mt-4">
                            <div class="d-flex justify-content-center links">
                                Voltar? <a href="<?= $router->route("web.login")?>" class="ml-2">Entrar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <script>


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
        <style>
                	/* Coded with love by Mutiullah Samim */
    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        background: #60a3bc !important;
    }
    .user_card {
        left: 110%;
        height: 400px;
        width: 350px;
        margin-top: auto;
        margin-bottom: auto;
        background: #f39c12;
        position: relative;
        display: flex;
        justify-content: center;
        flex-direction: column;
        padding: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 5px;

    }
    .justify-content-center.h-100.login{
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
    }
    .brand_logo_container {
        position: absolute;
        height: 170px;
        width: 170px;
        top: -75px;
        border-radius: 50%;
        background: #60a3bc;
        padding: 10px;
        text-align: center;
    }
    .brand_logo {
        height: 150px;
        width: 150px;
        border-radius: 50%;
        border: 2px solid white;
    }
    .form_container {
        margin-top: 100px;
    }
    .login_btn {
        width: 100%;
        background: #c0392b !important;
        color: white !important;
    }
    .login_btn:focus {
        box-shadow: none !important;
        outline: 0px !important;
    }
    .login_container {
        padding: 0 2rem;
    }
    .input-group-text {
        background: #c0392b !important;
        color: white !important;
        border: 0 !important;
        border-radius: 0.25rem 0 0 0.25rem !important;
    }
    .input_user,
    .input_pass:focus {
        box-shadow: none !important;
        outline: 0px !important;
    }
    .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
        background-color: #c0392b !important;
    }
    
    

            </style>