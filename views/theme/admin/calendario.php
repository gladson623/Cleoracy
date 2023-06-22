<!DOCTYPE html>
<html>

<head>
    <title>Dashboard de Administrador</title>
    <!-- Adicione os links de referência ao Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://cleoracy.online/views/theme/app/evo/css/evo-calendar.css" />
    <link rel="stylesheet" type="text/css" href="http://cleoracy.online/views/theme/app/evo/css/evo-calendar.midnight-blue.css" />

    <script src="http://cleoracy.online/views/theme/app/evo/js/evo-calendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <!-- Barra de navegação -->
    <div class="login_form_callback"> <?php flash(); ?></div>
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
    <div class="container-fluid a">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.cardapio")?>">Gerenciar Cardapio do dia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gerenciar Calendário</a>
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
                        <h5 class="card-title">Manutenção Calendário</h5>

                        <div id="calendar"></div>


                        <br>
                        <button class="btn btn-primary" id="btnModalA">Adicionar Evento</button>
                        <button class="btn btn-danger" id="btnModalR">Remover Evento</button>
                    </div>

                    <div class="modal" id="addModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Conteúdo do modal -->
                                <div class="modal-header">
                                    <h5 class="modal-title">Calendario - Adicionar Evento</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="<?= $router->route("auth.saveCalEvent") ?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="evento">Nome do Evento</label>
                                            <input type="text" name="eventName" class="form-control" id="evento">
                                        </div>
                                        <div class="form-group">
                                            <label for="descricao">Descrição do Evento</label>
                                            <input type="text" name="eventDesc" class="form-control" id="descricao">
                                        </div>

                                        <div class="form-group">
                                            <label for="type">Tipo do evento</label>
                                            <select type="text" name="eventType" class="form-control" id="type">

                                                <option value="1">Feriado/Recesso</option>
                                                <option value="2">Evento importante</option>
                                                <option value="3">Aniversário</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="data">Data do Evento</label>
                                            <input type="date" name="eventDate" class="form-control" id="data">
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="save">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal" id="delModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Conteúdo do modal -->
                                <div class="modal-header">
                                    <h5 class="modal-title">Calendario - Remover Evento</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="taaa">
                                    <form method="post" action="<?= $router->route("auth.delCalEvent") ?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="selectForm">Evento para ser excluido</label>
                                            <select name="event" style="margin-left: 10px;" class="form-control select-custom" id="selectForm"></select>

                                            <br>


                                        </div>

                                        <div class="form-group">

                                            <button type="submit" class="btn btn-danger d-block" id="save">Excluir</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


</body>

</html>
<style>
    .select-custom {
        display: inline-block;
        position: relative;
        width: 200px;
    }

    .select-custom select {
        width: 100%;
        height: 40px;
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        appearance: none;
        background-color: #fff;
        background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='6' viewBox='0 0 12 6'%3E%3Cpath fill='%23333' d='M6 6L0 0h12z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        cursor: pointer;
    }

    .select-custom select:focus {
        outline: none;
        border-color: #888;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.3);
    }

    .select-custom option {
        padding: 8px;
        font-size: 16px;
        background-color: #fff;
        color: #333;
    }


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
    $(function() {
        $("form").submit(function(e) {
            e.preventDefault();

            var form = $(this);


            var action = form.attr("action");
            var data = new FormData(this);

            form.trigger('reset');  

            $.ajax({
                url: action,
                data: data,
                type: "post",
                dataType: "json",
                beforeSend: function() {
                    swal.showLoading();

                },
                success: function(su) {

                    Swal.close();

                    if (su.message) {

                        Swal.fire({
                            icon: su.message.type === 'error' ? 'error' : 'success',
                            title: su.message.type === 'error' ? 'Erro' : 'Sucesso',
                            text: su.message.message,
                        });

                        if (su.message.type === 'success') {
                            delModal.style.display = "none";
                            addModal.style.display = "none";
                            getCalendarEvents();
                            
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
    });

    function flash(type, message) {

        Swal.fire({
            icon: type === 'error' ? 'error' : 'success',
            title: type === 'error' ? 'Erro' : 'Sucesso',
            text: message
        });

    }




    var btnModalA = document.getElementById("btnModalA");
    var btnModalR = document.getElementById("btnModalR");
    var addModal = document.getElementById("addModal");
    var delModal = document.getElementById("delModal");
    var closeButtonA = addModal.querySelector(".close");
    var closeButtonR = delModal.querySelector(".close");

    btnModalA.addEventListener("click", function() {
        addModal.style.display = "block";
    });

    btnModalR.addEventListener("click", function() {
        delModal.style.display = "block";
    });


    closeButtonR.addEventListener("click", function() {
        delModal.style.display = "none";
    });

    closeButtonA.addEventListener("click", function() {
        addModal.style.display = "none";
    });



    window.addEventListener("click", function(event) {
        if (event.target === addModal) {
            addModal.style.display = "none";
        }

        if (event.target === delModal) {
            delModal.style.display = "none";
        }
    });



    const container = document.getElementById('taaa');

    function setupCal() {
      
        $('#calendar').evoCalendar({
            theme: "Midnight Blue",
            language: 'pt',
            'eventDisplayDefault': false
        });
    }

    function getCalendarEvents() {
        $.ajax({
            url: '<?= $router->route("auth.calendarEvents") ?>',
            method: 'POST',
            dataType: 'json',
            success: function(response) {


                let eventos = response.message.events;
                setupDel(eventos);

                $('#calendar').evoCalendar('destroy');

                setupCal();

                if(eventos) $('#calendar').evoCalendar('addCalendarEvent', eventos);

                // console.log($('#calendar').evoCalendar('calendarEvents'))

            },
            error: function(xhr, status, error) {

                console.error(error);
            }
        });
    }

    setupCal();
    getCalendarEvents();

    function setupDel(calendarEvents) {
        const list = document.getElementById("selectForm");
        list.innerText = '';

        if (!Array.isArray(calendarEvents) || calendarEvents.length === 0) {

            const listItem = document.createElement('option');

            listItem.innerText = "Nenhum evento!";
            list.appendChild(listItem);
            return;
        }



        calendarEvents.forEach(event => {
            const listItem = document.createElement('option');

            listItem.innerText = event.Name + " ( " + event.Date + " )";
            listItem.value = event.Id;

            list.appendChild(listItem);
        });

    }
</script>