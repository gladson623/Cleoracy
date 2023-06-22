<?php 

define("ROOT", realpath(dirname(__FILE__)));

define("SITE", [
    "name" => "Colégio Cleoracy",
    "desc" => "Cleoracy",
    "domain" => "",
    "locale" => "pt-BR",
    "root" => "http://localhost/cleoracy"
]);

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "escola",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

define("MAIL",[
    "host" => "smtp.sendgrid.net",
    "port" => "587",
    "user" => "apikey",
    "password" => "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",
    "from_name" => "Colégio cleoracy",
    "from_email" => "delliviercorp@gmail.com"
]);