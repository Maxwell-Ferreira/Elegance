<?php

namespace App\adm\controllers;

if (!defined('URL')){
    header("location: /");
    exit();
}

class AdmHome {
    private $dados;

    public function index() {

    	$listar = new \App\adm\models\Agendamento();
    	$this->dados["listaAgendamentos"] = $listar->listarAgendamentos();

        $carregarView = new \Config\ConfigView("home/index", $this->dados);
        $carregarView->renderizarAdm();
    }
}
