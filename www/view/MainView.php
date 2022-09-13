<?php
require_once(MB_BASE_PATH."view/BaseView.php");
require_once(MB_BASE_PATH."core/Warp.php");

class MainView extends BaseView {


    public function getWarp() {
      return Warp::getInstance();
    }

    public function render()
    {
        echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    '.$this->getCSS().'
                </head>
                <body>
                    <div class="wrapper">
                        <div class="buttons-block">
                            <button id="html-report-button" class="btn">HTML report</button>
                            <button id="csv-report-button" class="btn">CSV report</button>
                        </div>
                    </div>
                    <div class="inner-placeholder"></div>
                </body>
                '.$this->getScripts().'
                </html>';
    }

    public function getCSS() {

        return '<link rel="stylesheet" href="/tmp/styles/style.css?'.uniqid().'">';
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
        return '<script src="/tmp/scripts/functions.js?'.uniqid().'"></script>
                <script src="/tmp/scripts/script.js?'.uniqid().'"></script>';
    }

  }
