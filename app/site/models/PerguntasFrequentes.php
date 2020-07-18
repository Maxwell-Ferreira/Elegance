<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class PerguntasFrequentes{

    private $tabela = "perguntas_frequentes";
    private $result;

    public function listar(){

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT ca.id, ca.pergunta, ca.resposta
                          FROM {$this->tabela} ca 
                          ORDER BY ca.id ASC");
        $this->result['perguntas_frequentes'] = $listar->getResult();
        return $this->result['perguntas_frequentes'];
    }
}

