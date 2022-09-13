<?php
require_once(MB_BASE_PATH."model/BaseModel.php");

class ClientListModel extends BaseModel {


    public $isLoaded = false;

    public function getAllClients() {
       return $this->getWarp()->getDatabase()->getAll("SELECT * FROM mandanten");
    }

}
