<?php
require_once(MB_BASE_PATH."controller/BaseController.php");
require_once(MB_BASE_PATH."model/ReportModel.php");
require_once(MB_BASE_PATH."model/ClientListModel.php");

class AjaxController extends BaseController {
  public $data;

  public function getJSON() {
    $function = $this->getPostVariable('fnc');
    switch($function) {
        case "getAllClients":
          $this->data = (new ClientListModel())->getAllClients();
        break;
        case "getReport":
            $data = json_decode($this->getPostVariable("data"));
            $model = new ReportModel();
            $generatedData = $model->generateReport($data);
            $this->data = array('url' => $generatedData);
        break;
    }

    return json_encode(array('data' => $this->data), JSON_UNESCAPED_UNICODE);
  }

}
