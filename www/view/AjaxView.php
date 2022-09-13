<?php
require_once(MB_BASE_PATH."view/BaseView.php");

class AjaxView extends BaseView {

public function render() {
  echo $this->controller->getJSON();
}

}
