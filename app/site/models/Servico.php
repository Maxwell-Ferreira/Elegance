<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class Servico{

    private $tabela = "servico";
    private $result;

    public function listar(){

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT ca.*
                          FROM {$this->tabela} ca 
                          ORDER BY ca.idServico ASC");
        $this->result['servico'] = $listar->getResult();
        return $this->result['servico'];
    }

    public function vizualizarServico($id){
        $vizualizarServico = new \Site\models\helper\ModelsRead();

        $idServico = $id;
        $vizualizarServico->exeReadEspecifico("SELECT s.*
                          FROM {$this->tabela} s 
                          WHERE s.idServico = :id
                          ORDER BY s.idServico ASC", "id=$idServico");
        $this->result['servico'] = $vizualizarServico->getResult();
        return $this->result['servico'];
    }

}

