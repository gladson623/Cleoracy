<!DOCTYPE html>
      <html lang=pt-br><!DOCTYPE html>
      <html lang="pt-br">
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          
          <link rel="stylesheet" href="views/assets/css/projects/tecnologianaescola.css">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js'></script>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css'>
        <script src="views/assets/js/utils.js"></script>
        <script src="views/assets/js/nav.js"></script>
          <title>Colégio Cleoracy</title>
      </head>
      <body>
      <header class="p-3 text-white">
        <div class="login_form_callback"> <?= flash();?></div>
          <div class="">
            <div class="d-flex flex-wrap">
        
            <ul class="nav ">
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
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="<?= $router->route("app.calendario")?>">Calendário</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a href='https://cleuranet.cleoracy.online' class="dropdown-item" >CleuraNet</a></li>
                </ul>
              </li>
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
                  Áreas
                </a>
                <ul class="dropdown-menu">
                <?php if(getSessionUser()->Grupo == 'Aluno') echo '<li><a href='.$router->route("aluno.dashboard").' class="dropdown-item" >Aluno</a></li> <li><hr class="dropdown-divider"></li>' ?>
              <?php if(getSessionUser()->Grupo == 'Admin' || getSessionUser()->Grupo == 'Owner' || getSessionUser()->Grupo == 'Professor') echo '<li><a href='.$router->route("professor.dashboard").' class="dropdown-item" >Professor</a></li> <li><hr class="dropdown-divider"></li>' ?>
              <?php if(getSessionUser()->Grupo == 'Admin' || getSessionUser()->Grupo == 'Owner') echo '<li><a href='.$router->route("admin.dashboard").' class="dropdown-item" >Admin</a></li>' ?>
                </ul>
              </li>

              
              <div style="position: absolute; right: 2%; width: 50px; height: 50px;"><img  src="<?=getSessionUser()->Avatar?>" data-toggle="modal" data-target="#editModal" style="cursor: pointer; width: 100%; height: 100%; border-radius: 50%;"></div>
 
              
            </ul>
          </div>
        </div>
        <?= createEditProfile() ?>
         
        <div id="cropModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cortar Imagem</h5>
              <button type="button" class="close bcl" data-dismiss="#cropModal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="imagePreview"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="cropButton">Salvar</button>
              <button type="button" class="bcl btn btn-secondary" data-dismiss="#cropModal">Fechar</button>
            </div>
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
          <div class="col-md-6 text-center" style="right: 0; position: absolute;">
              <a href="https://www.facebook.com/colegiocleoracy" target="_blank">
                <i class="fab fa-facebook fa-2x mx-3" style="right: 2%; top: -15px; position: absolute;"></i>
              </a>
              <a href="https://www.instagram.com/colegiocleoracy/" target="_blank">
                <i class="fab fa-instagram fa-2x mx-3" style="right: 7%; top: -15px; position: absolute;"></i>
              </a>
            </div>           
        </footer>
      </html>
      <script>
        let baseImage = null;

    $(document).ready(function() {
      $('#editAvatar').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#imagePreview').html('<img src="' + e.target.result + '" id="previewImage">');
          $('#cropModal').modal('show');
          $('#previewBtn').prop('disabled', false);
          initializeCroppie();
        }
        reader.readAsDataURL(this.files[0]);
      });

      $('.bcl').on('click', function(){
        $('#cropModal').modal('hide');
      })

      $('#previewBtn').on('click', function(){
        $('#cropModal').modal('show');


      });

      function initializeCroppie() {
        var croppie = new Croppie(document.getElementById('previewImage'), {
          enableExif: true,
          viewport: {
            width: 200,
            height: 200,
            type: 'circle'
          },
          boundary: {
            width: 300,
            height: 300
          }
        });

        $('#cropButton').on('click', function() {
          croppie.result('base64').then(function(base64Image) {
            baseImage = base64Image;
            $('#cropModal').modal('hide');
            $('#filel').html('Imagem selecionada...');
          });
        });
      }
    });

    


$(function () {
    $("form").submit(function (e) {
      e.preventDefault();
  
      var form = $(this);
      var action = form.attr("action");
      var data = {
        Username: document.querySelector('#editU').value,
        Email: document.querySelector('#editEmail').value,
        Password: document.querySelector('#editOP').value,
        NewPassword: document.querySelector('#editNP').value,
        ConfPassword: document.querySelector('#editCNP').value,
        Avatar: baseImage == null ? '' : baseImage,
      };
  
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
    });
  });

  
  </script>
  <!-- <script>

var preview = $('.preview').croppie({
    enableOrientation: true,
    viewport: {
        type: 'circle'
    }
})

$('#editAvatar').on('change', function(){
      var reader = new FileReader();

      reader.onload = function(e) {

      }

      reader.readAsDataURL($this.files[0]);
    });
  </script> -->
  
