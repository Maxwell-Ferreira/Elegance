<?php

namespace App\adm\models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Horario{

    private $result;
    private $dados;
    private $inicio;
    private $termino;
    private $dadosInsere;
    
    public function listarHorariosFunc($func = null){
        $this->func = (string) $func;
        $listarHorariosFunc = new \App\adm\Models\helper\ModelsRead();
        $listarHorariosFunc->exeReadEspecifico("SELECT h.*
                                            FROM horario h
                                            WHERE h.funcHorario = :func 
                                            ORDER BY h.horario ASC", "func={$this->func}");
        $this->result = $listarHorariosFunc->getResult();
        return $this->result;
    }

    public function verDuracao($func = null){
        $this->func = (string) $func;
        $listarHorariosFunc = new \App\adm\Models\helper\ModelsRead();
        $listarHorariosFunc->exeReadEspecifico("SELECT h.duracao
                                            FROM horario h
                                            WHERE h.funcHorario = :func 
                                            LIMIT 1", "func={$this->func}");
        $this->result = $listarHorariosFunc->getResult();
        return $this->result;
    }

    public function cadHorarioFunc(array $dados){
        $this->dados = $dados;

        $valCampoVazio = new \App\adm\models\helper\ModelsCampoVazio();
        $valCampoVazio->validarDados($this->dados);

        if ($valCampoVazio->getResult()) {
            $this->valHorario();
        } else {
            $this->result = false;
        }
    }

    private function valHorario(){
        $inicio = explode(":", $this->dados['horario']);
        $duracao = explode(":", $this->dados['duracao']);
        $horario1 = $inicio[0]+$duracao[0];
        $horario2 = $inicio[1]+$duracao[1];
        if($horario2 >= 60){
            $horario1++;
            $horario2 = $horario2%60;
        }
        $horario = $horario1.":".$horario2;
        $horario = gmdate("H:i", date(strtotime($horario)));

        $this->inicio = $this->dados['horario'];
        $this->termino = $horario;

        $this->valHorario2();
    }

    private function valHorario2(){
        $listarHorarios = new Horario();
        $listaHorarios = $listarHorarios->listarHorariosFunc($this->dados['funcHorario']);
        $this->result = true;

        foreach($listarHorarios->result as $horarios){
            $partes = explode(" - ", $horarios['horario']);
            if(($this->inicio >= $partes[0] and $this->inicio < $partes[1]) or $this->termino >= $partes[0] and $this->termino < $partes[1]){
                $this->result = false;
                $_SESSION['msg'] = "<div class='alert alert-danger'> Horario não cadastrado: este horario se sobrepoe a outro horario!</div>";
                break;
            }
        }

        if($this->result){
            $this->prepararDados();
            $insere = new \App\adm\models\helper\ModelsCreate();
            $insere->exeCreate("horario", $this->dadosInsere);
            $_SESSION['msg'] = "<div class='alert alert-success'> Horario cadastrado!</div>";
        }
    }

    private function prepararDados(){
        $this->dadosInsere['horario'] = $this->inicio." - ".$this->termino;
        $this->dadosInsere['horarioReal'] = gmdate("H:i:s", date(strtotime($this->inicio)));
        $this->dadosInsere['duracao'] = $this->dados['duracao'];
        $this->dadosInsere['funcHorario'] = $this->dados['funcHorario'];
    }
}
