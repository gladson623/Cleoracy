<?php
 
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

class Horario extends DataLayer {

    public function __construct() {

        parent::__construct("turmas", ["Turma", "Day", "StartTime", "EndTime", "Professor"], "Id", false);
        
    }


    public function save() : bool {

        return parent::save();
    }
}