<?php
require_once(MB_BASE_PATH."core/Base.php");
require_once(MB_BASE_PATH."core/Database.php");
require_once(MB_BASE_PATH."core/Config.php");
require_once(MB_BASE_PATH."core/Language.php");
require_once(MB_BASE_PATH."core/Utils.php");
require_once(MB_BASE_PATH."core/Logger.php");

class  Warp extends Base {
    private static $instance = null;

    public function __construct() {
      parent::__construct();
    }

    public static function getInstance()
    {
        if(!isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getDatabase() {
        return Database::getInstance();
    }

    public static function getLogger() {
        return Logger::getInstance();
    }

    public static function getConfig() {
        return Config::getInstance();
    }

    public static function getUtils() {
        return Utils::getInstance();
    }

    public static function getLanguage() {
        return Language::getInstance();
    }


}
