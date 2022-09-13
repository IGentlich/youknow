<?php
require_once(MB_BASE_PATH."core/Base.php");

class Database extends Base {

  public $connection;
  private static $instance = null;

  public function __construct()
  {
      return $this->connection = $this->connect();
  }

  public static function getInstance()
  {
      if(!self::$instance) {
          self::$instance = new Database();
      }

      return self::$instance;
  }

  protected function connect()
  {
      $servername = 'db';
      $username   = 'root';
      $password   = 'test';
      $database   = 'youknow';
      try {
          $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
          $conn->exec("set names utf8");
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $conn;
      } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
      }
  }

  public function getRow($sql, $parameters = array())
  {
      try {
          $stmt = $this->connection->prepare($sql);
          $stmt->execute($parameters);
          return $stmt->fetch(PDO::FETCH_ASSOC);
      } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
  }

  public function query($sql, $parameters = array())
  {
      try {
          $stmt = $this->connection->prepare($sql);
          $stmt->execute($parameters);
      } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
  }


  public function getAll($sql, $parameters = array())
  {
      try {
          $stmt = $this->connection->prepare($sql);
          $stmt->execute($parameters);
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
  }

  public function getOne($sql, $parameters = array())
  {
      try {
          $stmt = $this->connection->prepare($sql);
          $stmt->execute($parameters);
          return $stmt->fetchColumn();

      } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
  }

  public function getCount($sql, $parameters = array())
  {
      try {
          $stmt = $this->connection->prepare($sql);
          $stmt->execute($parameters);
          return $stmt->rowCount();
      } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
  }

}
