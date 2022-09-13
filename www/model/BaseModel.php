<?php
require_once(MB_BASE_PATH."core/Base.php");
require_once(MB_BASE_PATH."core/Warp.php");

class BaseModel extends Base {


    public $isLoaded = false;
    public $table;

    /**
     * BaseModel constructor.
     */
    public function __construct()
    {

    }

    public function load($id)
    {

    }

    public function save()
    {

    }

    public function getWarp() {
      return Warp::getInstance();
    }

    public function exists() {

    }

}
