<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /");
    exit();
}


class Perfil{

    private $result;

    public function listarAtendimentosPerfil(){
        $id = $_SESSION['idCliente'];
        $listar = new \Site\models\helper\ModelsRead();

        $listar->exeReadEspecifico("SELECT a.*, h.horario, f.nomeFunc, s.descServico, s.imagemServico
                                    FROM atendimento a INNER JOIN horario h
                                        ON a.horario = h.idHorario INNER JOIN funcionario f
                                            ON h.funcHorario = f.idFunc INNER JOIN servico s
                                                ON f.servicoFunc = s.idServico
                                    WHERE a.cliente = :id
                                    ORDER BY a.idAtendimento DESC", "id=$id" );
        $this->result['atendimentosPerfil'] = $listar->getResult();
        return $this->result['atendimentosPerfil'];   
    }
}
