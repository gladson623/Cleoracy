<?php
 
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

class Turma extends DataLayer {

    public function __construct() {

        parent::__construct("turmas", ["Name", "Description", "Materias"], "Id", false);
        
    }


    public function save() : bool {

        return parent::save();
    }
}