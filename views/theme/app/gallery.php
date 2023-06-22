<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Colégio Cleoracy</title>
</head>
<body>

    

    <h1>Galeria de fotos</h1> <br>
    <h3>

    <?= getGallery(); ?>
    </h3>

    <p> <a class="hover-animation" href="<?= $router->route("app.home") ?>">← Voltar</a></p>
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
    }

    h3 img{


        height: 30%;
        width: 30%;
        border-radius: 50%;
        
    }
    p a:hover {
        transition: all 0.2s;
        border-bottom: solid 2px;

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

    h3 {

        align-items: center;
        text-align: center;
        
        font-size: xx-large;

        font-family: cursive;

    }


</style>