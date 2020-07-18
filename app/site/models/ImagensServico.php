<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class Logos{

    private $tabela = "logos";
    private $result;

    public function listar(){

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT ca.id, ca.nome, ca.imagem
                          FROM {$this->tabela} ca 
                          ORDER BY ca.id ASC");
        $this->result['logos'] = $listar->getResult();
        return $this->result['logos'];
    }
}

