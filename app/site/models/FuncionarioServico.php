<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class FuncionarioServico{

    private $tabela = "funcionario_servico";
    private $result;

    public function listar(){

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("
                          SELECT fs.id as idAloc, s.idServico, s.descServico, f.id, f.nome
                          FROM funcionario f, funcionario_servico fs, servico s
                          WHERE f.id = fs.funcionario AND s.idServico = fs.servico
                          ORDER BY s.idServico ASC");
        $this->result['funcionario_servico'] = $listar->getResult();
        return $this->result['funcionario_servico'];
    }
}

