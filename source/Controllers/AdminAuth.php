<?php

namespace Source\Controllers;

use Source\Models\Cardapio;


class AdminAuth extends Controller
{


    public function __construct($router)
    {

        parent::__construct($router);
    }

    public function saveCardapio($data): void
    {
        date_default_timezone_set('America/Sao_Paulo');
            
        $data = filter_var_array($data, FILTER_SANITIZE_SPECIAL_CHARS);


        $today = date("Y-m-d");

        try {

            if (in_array("", $data)) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor preencher todos os campos."
                ]);

                return;
            }

            $dishName = filter_var($data["dishName"], FILTER_DEFAULT);



            if (!$dishName) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor informar dados válidos."
                ]);

                return;
            }

            if (!isset($_FILES["dishImage"])) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor enviar uma imagem."
                ]);

                return;
            }

            $dishImage = $_FILES["dishImage"];

            if ($dishImage['error']) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Erro no envio da imagem."
                ]);

                return;
            }

            if ($dishImage['size'] > 2097152) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Arquivo muito grande! Max: 2MB"
                ]);

                return;
            }


            $pasta = "Client/Files/Images/";
            $ImageName = $dishImage['name'];
            $newImageName = uniqid();


            $ext = strtolower(pathinfo($ImageName, PATHINFO_EXTENSION));

            $newPath = $pasta . $newImageName . "." . $ext;

            if ($ext != "jpg" && $ext != "png") {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Arquivo inválido."
                ]);

                return;
            }

            $result = move_uploaded_file($dishImage["tmp_name"], ROOT . "/" . $newPath);


            if (!$result) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Erro ao fazer upload do arquivo."
                ]);

                return;
            }


            
            $cardapio = new Cardapio();



            $cardapio->Name = $dishName;
            $cardapio->Image = $newPath;
            $cardapio->Date = $today;




            $cardapio->saveCardapio();


 
            

            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Cardápio alterado com sucesso!"
            ]);
        } catch (\Exception $error) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $error->getMessage()
            ]);
        }
    }
}
