<?php
 
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

class Cardapio extends DataLayer {

    public function __construct() {
        parent::__construct("cardapios", ["Name", "Image", "Descricao" , "Date"], "Id", false);
    }




    public function saveCardapio() {

        $today = date("Y-m-d");

        if($cardapioByDate = $this->find("Date = :d", "d={$today}")->fetch()) $this->Id = $cardapioByDate->Id;


        if(!parent::save()) {
            throw new Exception('Não foi possível salvar o cardapio no banco de dados!');
        }
    }
}