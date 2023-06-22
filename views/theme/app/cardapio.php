<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Colégio Cleoracy</title>
</head>
<body>
    <h1>Cardápio do DIA (<?= date("d-m-Y") ?>)</h1>
    <h3>

    <?= getTodayMenu(); ?>
    </h3>

    <p> <a class="hover-animation" href="<?= $router->route("app.home") ?>"> ← Voltar</a></p>
</body>
</html>


<style> 

    html {
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, #607D8B, #ECEFF1) no-repeat;
        background-size: cover;
        text-align: center;
        font-family: monospace;
        font-size: xx-large;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }


    h3 img{


        height: 300px !important;
        width: 300px !important;
        border-radius: 50% !important;
        
    }
    p {
        left: 5%;
        top: 0%;
        position: absolute;
    }

    p a {
        color: blue;
        font-size: 50px;
    }
    a {
        font-size: xx-large;
        font-family: cursive;

        text-decoration: none;
        color: black;
        left: 0;
    }
    h3 {

        align-items: center !important;
        text-align: center !important;
        
        font-size: xx-large !important;

        font-family: cursive !important;

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
    p a:hover {
        transition: all 0.2s;
        border-bottom: solid 2px;

    }


</style>