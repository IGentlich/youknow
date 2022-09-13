<?php
require_once(MB_BASE_PATH."core/Base.php");

class Config extends Base {

    private static $instance = null;
    protected $params;
    protected $test = 0;

    public function __construct() {
      $this->params = array(
        
      );
    }

    public static function getInstance()
    {
        if(!isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getParam($name) {
      return $this->params[$name];
    }
}
