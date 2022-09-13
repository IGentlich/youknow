<?php
require_once(MB_BASE_PATH."view/BaseView.php");
require_once(MB_BASE_PATH."model/BaseModel.php");
require_once(MB_BASE_PATH."core/Base.php");
require_once(MB_BASE_PATH."core/Warp.php");

class BaseController extends Base {
    public $model;

    /**
     * BaseController constructor.
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getWarp() {
      return Warp::getInstance();
    }

}
