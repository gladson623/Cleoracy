<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/assets/css/error.css">

    <title>Ooops</title>
</head>
<body>
    <h1> Ooops, erro <?= $error ?></h1>
    <h3> Desculpe pelo erro, caso o mesmo persista favor contatar a secretaria da escola </h3>
    <button><a href="<?= $router->route("web.login") ?>"> Voltar </a></button>

</body>
</html>