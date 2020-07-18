<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class Notificacao{

    private $tabela = "notificacao";
    private $result;

    public function listar(){

        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT n.*
                          FROM {$this->tabela} n
                          ORDER BY n.idNot ASC");
        $this->result['notificacao'] = $listar->getResult();
        return $this->result['notificacao'];
    }

    public function listarNotUser($User){
        $listarNotUser = new \Site\models\helper\ModelsRead();
        $listarNotUser->exeReadEspecifico("SELECT n.*, c.nomeCliente, s.*, a.*, h.*
                                        FROM {$this->tabela} n 
                                            INNER JOIN cliente c
                                                ON c.idCliente = n.solicitante
                                            INNER JOIN atendimento a
                                                ON a.idAtendimento = n.agendamento
                                            INNER JOIN horario h
                                                ON h.idHorario = a.horario
                                            INNER JOIN funcionario f
                                                ON f.idFunc = h.funcHorario
                                            INNER JOIN servico s
                                                ON s.idServico = f.servicoFunc
                                        WHERE n.solicitado = :user", "user=$User");
        $this->result['notificacao'] = $listarNotUser->getResult(); 
        return $this->result['notificacao']; 
    }

    public function listarNotAgendamento($Agendamento){
        $listarNotUser = new \Site\models\helper\ModelsRead();
        $listarNotUser->exeReadEspecifico("SELECT n.*
                                        FROM {$this->tabela} n INNER JOIN atendimento a
                                            ON n.agendamento = a.idAtendimento
                                        WHERE n.solicitado = :atendimento", "atendimento=$Atendimento");
        $this->result['notificacao'] = $listarNotUser->getResult();
        return $this->result['notificacao'];  
    }
}

