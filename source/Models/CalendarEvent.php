<?php
 
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

class CalendarEvent extends DataLayer {

    public function __construct() {
        parent::__construct("calendarevents", ["Name", "Date", "Description", "Type", "everyYear"], "Id", false);
    }




    public function saveEvent() {

        if(!parent::save()) {
            throw new Exception('Não foi possível salvar o evento no banco de dados!');
        }
    }

}