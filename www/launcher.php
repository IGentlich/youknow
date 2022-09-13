<?
require_once(MB_BASE_PATH."core/Base.php");
require_once(MB_BASE_PATH."core/Warp.php");
require_once(MB_BASE_PATH."metadata.php");
class Launcher extends Base {

private $metadata;

public function start() {
  ob_start();
  $this->metadata = new MetaData();

  $class = $this->getGetVariable('cl');
  if($class != '') {
    if(!in_array($class, array_keys($this->metadata->controllers))) {
      header("Location: http://localhost:8001/");
      die();
    }
  } else {
    header("Location: http://localhost:8001/");
    die();
  }

    include_once(MB_BASE_PATH."/model/{$this->metadata->models[$class]}.php");
    include_once(MB_BASE_PATH."/controller/{$this->metadata->controllers[$class]}.php");
    include_once(MB_BASE_PATH."/view/{$this->metadata->views[$class]}.php");

    $model      = new $this->metadata->models[$class]();
    $controller = new $this->metadata->controllers[$class]($model);
    $view       = new $this->metadata->views[$class]($controller);
    $view->render();

  ob_end_flush();

  }
}
