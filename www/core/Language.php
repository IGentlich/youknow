<?php
require_once(MB_BASE_PATH."core/Base.php");

class Language extends Base {

    private $data = array();
    private static $instance = null;

    public static function getInstance()
    {
        if(!isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct() {
    }

}
