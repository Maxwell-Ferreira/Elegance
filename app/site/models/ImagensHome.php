<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class ImagensHome{

    private $tabela = "imagensHome";
    private $result;

    public function listar(){

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT ca.id, ca.nome, ca.imagem
                          FROM {$this->tabela} ca 
                          ORDER BY ca.id ASC");
        $this->result['imagensHome'] = $listar->getResult();
        return $this->result['imagensHome'];
    }
}

