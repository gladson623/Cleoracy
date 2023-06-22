<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

    <link rel="stylesheet" type="text/css" href="http://cleoracy.online/views/theme/app/evo/css/evo-calendar.css"/>
    <link rel="stylesheet" type="text/css" href="http://cleoracy.online/views/theme/app/evo/css/evo-calendar.midnight-blue.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://cleoracy.online/views/theme/app/evo/js/evo-calendar.js"></script>
    
    <title>Colégio Cleoracy</title>
</head>
<body>

<div id="calendar"></div>

<p id="voltar"> <a class="hover-animation" href="<?= $router->route("app.home") ?>"> ← Voltar</a></p>



<script>
// initialize your calendar, once the page's DOM is ready
$(document).ready(function() {
    $('#calendar').evoCalendar({
        theme: 'Midnight Blue',
        language: 'pt',
        eventDisplayDefault: false        
    })
})

function getCalendarEvents() {
        $.ajax({
            url: '<?= $router->route("auth.calendarEvents") ?>',
            method: 'POST',
            dataType: 'json',
            success: function(response) {


                let eventos = response.message.events;

                if(eventos) $('#calendar').evoCalendar('addCalendarEvent', eventos);


            },
            error: function(xhr, status, error) {

                console.error(error);
            }
        });
}

getCalendarEvents();

</script>

<style>

    #calendar {
        width: 80%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    html {
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, #607D8B, #ECEFF1) no-repeat;
        background-size: cover;
    }

    p a:hover {
        transition: all 0.2s;
        border-bottom: solid 2px;

    }

    #voltar {
        left: 5%;
        top: 1%;
        position: absolute;
        width: 20%;

    }
    .hover-animation {
  position: relative;
  display: inline-block;
  text-decoration: none;
  transition: color 0.3s;
}

.hover-animation::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 2px;
  bottom: 0;
  left: 0;
  background-color: #000;
  visibility: hidden;
  transform: scaleX(0);
  transition: all 0.3s ease-in-out;
}

.hover-animation:hover {
  color: blue; /* Altere para a cor desejada */
}

.hover-animation:hover::before {
  visibility: visible;
  transform: scaleX(1);
}
    #voltar a {
        
        color: blue;
        font-size: 50px;
        position: absolute;
        font-family: cursive;

        text-decoration: none;
    }




</style>



</body>
</html>

