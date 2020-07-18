<?php

namespace Site\controllers;

 if (!defined('URL')){
     header("location: /");
     exit();
 }

class Contato {

    public function index() {
        $carregarView = new \Config\ConfigView("contato/index");
        $carregarView->renderizar();
    }
}
