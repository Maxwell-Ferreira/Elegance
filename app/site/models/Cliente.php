<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class ImagensHome{

    private $tabela = "cliente";
    private $result;

    public function listar(){

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT c.*
                          FROM {$this->tabela} c
                          ORDER BY c.idCliente ASC");
        $this->result['imagensHome'] = $listar->getResult();
        return $this->result['imagensHome'];
    }
}
