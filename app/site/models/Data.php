<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class Data{

    private $tabela = "data";
    private $result;

    public function listar(){

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT ca.*
                          FROM {$this->tabela} ca 
                          ORDER BY ca.idData ASC");
        $this->result['data'] = $listar->getResult();
        return $this->result['data'];
    }

   /* public function selecionarDatasPorFuncionario($id){
        $datas = new \Site\models\helper\ModelsRead();

        $idData = $id;
        $datas->exeReadEspecifico("SELECT d.*
                          FROM {$this->tabela} d, horario_data hd, horario h, funcionario f
                          WHERE d.idData = hd.data AND hd.horario = h.idHorario AND h.funcHorario = :id
                          GROUP BY d.idData
                          ORDER BY d.idData ASC", "id=$idData");
        $this->result['datasServico'] = $datas->getResult();
        return $this->result['datasServico'];
    } */

}

