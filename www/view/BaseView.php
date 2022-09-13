<?php
require_once(MB_BASE_PATH."core/Base.php");
require_once(MB_BASE_PATH."core/Warp.php");

class BaseView extends Base {

    public $controller;

    public function __construct($controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    public function getWarp() {
      return Warp::getInstance();
    }

    public function render()
    {
        echo '';
    }

    public function getCSS() {

        return '';
    }

    public function getLoader($size, $color, $ident)
    {
        return '<div class="'.$size.'-loader '.$color.'-loader '.$ident.'">
                    <div class="loader">
                        <div class="point-one"></div>
                        <div class="point-two"></div>
                        <div class="point-three"></div>
                    </div>
                </div>';
    }

    public function getHeaderBlock() {

      return '<div class="header">
                <div class="header-inside">
                  <div class="header-left-side fll">
                    <div class="hamburger-mobile-icon sdn fll" onclick="showMobileSidebar()"></div>
                    <a href="/"><img class="logo" alt="logo" src="'.$this->getWarp()->getConfig()->getParam('tmp_path').'logo_mini.png"></a>
                    <div class="search-mobile-icon sdn flr" onclick="showMobileSearch()"></div>
                    <div class="clear"></div>
                  </div>
                  <div class="header-right-side flr">
                    <form class="search-form mdn" action="/search" method="GET" autocomplete="off">
                      <input name="query" type="search" placeholder="Filme, Serien und mehr...">
                      <input class="mdn" type="submit" value="">
                    </form>
                  </div>
                  <div class="clear"></div>
                </div>
              </div>';
    }

    public function getSidebar($noSidebar = false) {
      return '';
    }

    public function getSidebarItems() {
      return '';
    }

    public function getFooter() {
      return '';
    }

    public function getScripts() {
        return $this->getJS().$this->getAnalyticsJS();
    }

  }
