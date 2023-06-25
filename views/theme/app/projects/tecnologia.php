<!DOCTYPE html>
      <html lang="pt-br">
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-fullscreen-plugin/1.1.5/jquery.fullscreen-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <title>Projeto Escola e Tecnologia</title>
      </head>
      <header class="p-3">
        <div class="login_form_callback"> <?= flash();?></div>
          <div class="">
            <div class="d-flex flex-wrap">
        
              <ul class="nav ">
                <li><a href="<?=$router->route("app.home")?>" class="nav-link px-2 text-dark">Inicio</a></li>
                <li><a href="#" class="nav-link px-2 text-white" data-toggle="modal" data-target="#AntesModal">Como era antes?</a></li>
                <li><a href="#" class="nav-link px-2 text-white" data-toggle="modal" data-target="#HojeModal">Hoje em dia</a></li>
                <li><a href="#" class="nav-link px-2 text-white" data-toggle="modal" data-target="#CausasModal">O que causou?</a></li>
              </ul>
            </div>
          </div>
        </header>
      <body>


        <div class="container d-flex" >
          <div class="row">
            <div class="col">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AntesModal">Slide 1</button>
            </div>
            <div class="col">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#HojeModal">Slide 2</button>
            </div>
            <div class="col">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CausasModal">Slide 3</button>
            </div>
          </div>
        </div>

        <div id="Antes">
          <div class="modal fade" id="AntesModal" tabindex="-1" role="dialog" aria-labelledby="slideShowModalLabel" aria-hidden="true">
            <div class="modal-dialog size" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="slideShowModalLabel">Apresentação de Slides</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="">
                  <div id="carouselExampleIndicators" class="carousel slide"  data-interval="false">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="../../../assets/images/aprendizagem.png" class="d-block w-100" alt="Slide 1">
      
                      </div>
                      <div class="carousel-item">
                        <img src="../../../assets/images/avaliacao.png" class="d-block w-100" alt="Slide 2">
      
                      </div>
                      <div class="carousel-item">
                        <img src="../../../assets/images/avancos.png" class="d-block w-100" alt="Slide 3">
      
                      </div>
                      <div class="carousel-item">
                        <img src="../../../assets/images/colaborativa.png" class="d-block w-100" alt="Slide 4">
      
                      </div>
                      <div class="carousel-item active">
                        <img src="../../../assets/images/gamificacao.png" class="d-block w-100" alt="Slide 5">
      
                      </div>
                      <div class="carousel-item">
                        <img src="../../../assets/images/movel.png" class="d-block w-100" alt="Slide 6">
      
                      </div>
                      <div class="carousel-item">
                        <img src="../../../assets/images/potencial.png" class="d-block w-100" alt="Slide 7">
      
                      </div>
                      <div class="carousel-item">
                        <img src="../../../assets/images/realidade.png" class="d-block w-100" alt="Slide 8">
      
                      </div>
                      
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Próximo</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="Hoje">
          <div class="modal fade" id="HojeModal" tabindex="-1" role="dialog" aria-labelledby="slideShowModalLabel" aria-hidden="true">
            <div class="modal-dialog size" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="slideShowModalLabel">Apresentação de Slides</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="">
                  <div id="HojeIndicators" class="carousel slide"  data-interval="false">
                    <ol class="carousel-indicators">
                      <li data-target="#HojeIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#HojeIndicators" data-slide-to="1"></li>
                      <li data-target="#HojeIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="https://via.placeholder.com/800x400/000000/FFFFFF" class="d-block w-100"  alt="Slide 1">
                      </div>
                      <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400/0000FF/FFFFFF" class="d-block w-100" alt="Slide 2">
                      </div>
                      <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400/FF0000/FFFFFF" class="d-block w-100" alt="Slide 3">
      
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#HojeIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#HojeIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Próximo</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="Causas">
          <div class="modal fade" id="CausasModal" tabindex="-1" role="dialog" aria-labelledby="slideShowModalLabel" aria-hidden="true">
            <div class="modal-dialog size" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="slideShowModalLabel">Apresentação de Slides</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="">
                  <div id="CausasIndicators" class="carousel slide"  data-interval="false">
                    <ol class="carousel-indicators">
                      <li data-target="#CausasIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#CausasIndicators" data-slide-to="1"></li>
                      <li data-target="#CausasIndicators" data-slide-to="2"></li>
                      <li data-target="#CausasIndicators" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="https://via.placeholder.com/800x400/000000/FFFFFF" class="d-block w-100" alt="Slide 1">
                      </div>
                      <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400/0000FF/FFFFFF" class="d-block w-100" alt="Slide 2">
      
                      </div>
                      <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400/FF0000/FFFFFF" class="d-block w-100" alt="Slide 3">
      
                      </div>
                      <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400/FF0000/FFFFFF" class="d-block w-100" alt="Slide 4">
      
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#CausasIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#CausasIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Próximo</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </body>
      <footer id="footer" class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <div class="col-md-4 d-flex align-items-center">
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


      <script>
        
        function flash(type, message) {

          Swal.fire({
          icon: type === 'error' ? 'error' : 'success',
          title: type === 'error' ? 'Erro' : 'Sucesso',
          text: message
          });

        }

        var currentModal = null;

        $('.modal').on('shown.bs.modal', function (e) {

            currentModal = $(this);
        });

        $(document).on('keyup',function(e) {
            if (currentModal && currentModal.find('.carousel').length) {

                if(e.keyCode == 32) {

                    currentModal.carousel('next');

                } else if (e.keyCode == 8) {

                    currentModal.carousel('prev');
                    return;

                } 
                    
            }
        });

        $(document).on('keyup', function(e) {


            if(e.keyCode === 65 || e.keyCode === 67 ||e.keyCode === 72 ) {

                if(currentModal != null) currentModal.modal('hide');

                if (e.keyCode === 65) { 
              
                    $('#AntesModal').modal('show');
                    return;
                }
                if (e.keyCode === 67) { 

                    $('#CausasModal').modal('show'); 
                    return;
                }

                $('#HojeModal').modal('show'); 

            }

        });
  


      </script>
      <style>

        

                .carousel-caption {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            color: white;
            text-shadow: 1px 1px 2px black;
        }

        html, body {

            background-color: #bfbbb8;

        }

        header {

            background-color: #52858a;

        }

        footer {

            color: black;
            font-size: 14px;
        }

        footer a {
            color: #555;
        }

        footer a:hover {
            color: #333;
        }

        footer i {
            transition: color 0.2s ease-in-out;
        }

        footer i:hover {
            color: #555;
        }


        #footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: auto;
            }

        .size {
            max-width: 1700px !important;
            width: 100% !important;
        }




      </style>