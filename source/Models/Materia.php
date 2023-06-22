<?php
 
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

class Materia extends DataLayer {

    public function __construct() {

        parent::__construct("materias", ["Name", "Turma"], "Id", false);
        
    }


    public function save() : bool {

        return parent::save();
    }
}