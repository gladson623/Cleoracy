<?php

use Source\Models\Cardapio;
use Source\Models\User;
    function projetos() : array {


        return ["tecnologia"];

    }

    function site(string $param = null) : string {

        if($param && !empty(SITE[$param])) return SITE[$param];

        return SITE["root"];

    }

    function asset(string $path): string {

        return SITE["root"]."/views/assets/{$path}";

    }

    function flash(string $type = null, string $message = null): ?string {
        if($type && $message) {
            $_SESSION["flash"] = [
                "type" => $type,
                "message" => $message
            ];

            return null;
        }

        if(!empty($_SESSION["flash"]) && $flash = $_SESSION["flash"]) {
            unset($_SESSION["flash"]);

            $type = $flash["type"];
            $message = $flash["message"];

            return "<script> flash('$type', '$message') </script>";
        }

        return null;
    }

    function getTodayMenu() : string {

        $date = date("Y-m-d");

        $cardapio = (new Cardapio)->find("Date = :d", "d={$date}")->fetch();

        if(!$cardapio) return "Nenhum cardápio cadastrado no dia de hoje";

        return "Nome do prato: ".$cardapio->Name."<br> <img src='localhost/cleoracy/source/".$cardapio->Image."'>";
    }

    function routeImage(string $imageUrl): string {

        return "https://via.placeholder.com/1200x628/0984e3/FFFFFF?text={$imageUrl}";

    }