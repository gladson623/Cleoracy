<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cardápio do DIA (<?= date("d-m-Y") ?>)</h1>
    <h3>

    <?= getTodayMenu(); ?>
    </h3>
</body>
</html>