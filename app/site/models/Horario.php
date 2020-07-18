<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class Horario{

    private $tabela = "horario";
    private $result;

    public function listar(){

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT h.*
                          FROM {$this->tabela} h
                          ORDER BY h.idHorario ASC");
        $this->result['horarios'] = $listar->getResult();
        return $this->result['horarios'];
    }

    public function listarHorariosDisponiveis($data, $func){
        $listar = new \Site\models\helper\ModelsRead();
        $listar->exeReadEspecifico("SELECT p.* 
                                      FROM (SELECT :data data, idHorario, horario, funcHorario, horarioReal FROM horario WHERE funcHorario = :func) p
                                      LEFT JOIN atendimento c ON p.idHorario=c.horario AND p.data=c.data
                                      WHERE c.data is NULL;", "data=$data&func=$func");
        $this->result['horariosDisponives'] = $listar->getResult();
        return $this->result['horariosDisponives']; 
    }

    public function qtdHorariosDisponiveisDataFunc($data, $func){
        $listar = new \Site\models\helper\ModelsRead();
        $listar->exeReadEspecifico("SELECT COUNT(p.idHorario) qtd
                                  FROM (SELECT :data data, idHorario, horario, funcHorario FROM horario) p
                                  LEFT JOIN atendimento c ON p.idHorario=c.horario AND p.data=c.data
                                  WHERE c.data is NULL AND p.funcHorario = :func
                                  GROUP BY p.funcHorario;", "data=$data&func=$func");
        $this->result['qtdHorarios'] = $listar->getResult();
        if(!empty($this->result['qtdHorarios'])){
          $resultado = $this->result['qtdHorarios'][0];  
        }else{
          $resultado = 0;
        }
        return $resultado; 
    }

    public function listarHorariosMarcadosPorData($data, $func){
        $listar = new \Site\models\helper\ModelsRead();
        $listar->exeReadEspecifico("SELECT h.* 
                                    FROM horario h INNER JOIN atendimento a
                                      ON h.idHorario = a.horario
                                    WHERE a.data = :data AND h.funcHorario = :func;", "data=$data&func=$func");
        $this->result['horariosMarcadosPorData'] = $listar->getResult();
        return $this->result['horariosMarcadosPorData']; 
    }
}
 
