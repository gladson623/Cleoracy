<?php
 
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

class User extends DataLayer {

    public function __construct() {

        parent::__construct("usuarios", ["First_Name", "Last_Name", "Username", "Password", "Email", "Verified"], "Id", false);
        
    }


    public function save() : bool {

        return parent::save();
    }
}