<?php
require_once(MB_BASE_PATH."core/Base.php");

class Utils extends Base {

    private static $instance = null;

    public static function getInstance()
    {
        if(!isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function redirect($url, $code = null)
    {
        header('Location: '.$url, true, $code);
        die();
    }

    public function setCookie($name, $value, $seconds)
    {
        $this->destroyCookie($name);
        setcookie($name, $value, time() + ($seconds), "/");
    }

    public function destroyCookie($name)
    {
      if(isset($_COOKIE[$name])) {
        unset($_COOKIE[$name]);
        setcookie($name, null, -1);
        return true;
      } else {
        return false;
      }
    }

    public function getCookie($name)
    {
        if(isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
    }

    public function changeCookie($name, $value)
    {
        if(isset($_COOKIE[$name])) {
          $this->destroyCookie($name);
        }
        setcookie($name, $value, time() + (86400 * 30), "/");
    }

    public function multiDimensionalArrayInOneDimensionalArray($array) {
      return array_map('current', $array);
    }

    public function printfArray($format, $arr)
    {
        return call_user_func_array('sprintf', array_merge((array)$format, $arr));
    }

    public function createCSV($data, $type, $fileName)
    {
      if(count($data) > 0) {
        $fields = array_keys($data[0]);
        
        if (!file_exists($_SERVER['DOCUMENT_ROOT']."/reports/csv")) {
          mkdir($_SERVER['DOCUMENT_ROOT'].'/reports/csv');
        }
        $file = $_SERVER['DOCUMENT_ROOT'].'/reports/csv/'.date("Y-m-d H:i:s").'-'.$type.'-'.$fileName;

        $fp = fopen($file, 'w');

        fputcsv($fp, $fields);
        foreach ($data as $item) {
          fputcsv($fp, $item);
        }
        return '/reports/csv/'.date("Y-m-d H:i:s").'-'.$type.'-'.$fileName;
      }
      return false;
    }

    public function createHtml($data, $type, $fileName)
    {
        
      if(count($data) > 0) {
        $fields = array_keys($data[0]);

        $content = '<table>';

        $content .= "<tr>";
        foreach ($fields as $field) {
          $content .= "<th><b>{$field}</b></th>";
        }
        $content .= "</tr>";

        foreach ($data as $item) {
          $content .= "<tr>";
          foreach ($item as $key => $value) {
            if($key == 'total') {
              if($value < 0) {
                $value = 0;
              }
              $value = $this->secondsToTime($value);
            }
            $content .= "<td>{$value}</td>";
          }
          $content .= "</tr>";
        }
        $content .= '</table>';

        if (!file_exists($_SERVER['DOCUMENT_ROOT']."/reports/html")) {
          mkdir($_SERVER['DOCUMENT_ROOT']."/reports/html");
        }
        $file = $_SERVER['DOCUMENT_ROOT'].'/reports/html/'.date("Y-m-d H:i:s").'-'.$type.'-'.$fileName;
        file_put_contents($file, $content. PHP_EOL, FILE_APPEND);
        return '/reports/html/'.date("Y-m-d H:i:s").'-'.$type.'-'.$fileName;
      }
      return false;
    }

    public function secondsToTime($seconds) {
      return sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);
    }

}
