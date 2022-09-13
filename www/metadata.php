<?
class MetaData {

public $models;
public $views;
public $controllers;

public function __construct() {
  $this->models      = [
                          'base'         => 'BaseModel',
                          'main'         => 'BaseModel',
                          'ajax'         => 'BaseModel',
                       ];
  $this->views       = [
                          'base'         => 'BaseView',
                          'main'         => 'MainView',
                          'ajax'         => 'AjaxView',
                       ];
  $this->controllers = [
                          'base'         => 'BaseController',
                          'main'         => 'MainController',
                          'ajax'         => 'AjaxController',
                       ];
}

}
