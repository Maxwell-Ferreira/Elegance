<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class Funcionario{

    private $tabela = "funcionario";
    private $result;

    public function listar(){

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT f.* FROM {$this->tabela} f 
                          ORDER BY f.idFunc ASC");
        $this->result['funcionario'] = $listar->getResult();
        return $this->result['funcionario']; 
    }
    public function listarFuncionariosServico($id){ 

        $idServico = $id;

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT f.* 
                            FROM {$this->tabela} f, servico s
                            WHERE f.servicoFunc = s.idServico AND s.idServico = :id 
                            ORDER BY f.idFunc ASC", "id=$idServico");
        $this->result['funcionario'] = $listar->getResult();
        return $this->result['funcionario']; 
    }

    public function buscarFuncionarioServico($idServico, $idFunc){ 

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT f.* 
                            FROM {$this->tabela} f, servico s
                            WHERE f.servicoFunc = s.idServico AND s.idServico = :idServico AND f.idFunc = :idFunc 
                            ORDER BY f.idFunc ASC", "idServico=$idServico&idFunc=$idFunc");
        $this->result['funcionario'] = $listar->getResult();
        return $this->result['funcionario']; 
    } 
}

