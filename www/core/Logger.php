<?php
require_once(MB_BASE_PATH."core/Base.php");

class Logger extends Base {

private static $instance = null;

public static function getInstance()
{
    if(!isset(self::$instance)){
        self::$instance = new self();
    }

    return self::$instance;
}

public function writeToLog($data, $fileName)
{
    $data = "[".date("Y-m-d H:i:s")."] ".$data;
    //mkdir($_SERVER['DOCUMENT_ROOT']."/live/tmp/log/");
    $cacheFile = $_SERVER['DOCUMENT_ROOT'].'/live/tmp/log/'.$fileName; 
    file_put_contents($cacheFile, $data. PHP_EOL, FILE_APPEND);
}

}
