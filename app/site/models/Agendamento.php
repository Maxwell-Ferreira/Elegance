<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /"); 
    exit();
}


class Agendamento{

    private $tabela = 'atendimento'; 
    private $result = false;
    private $dadosTroca;
    private $dadosNot;

    public function listar(){
        $listar = new \Site\models\helper\ModelsRead();
        $listar->exeReadEspecifico("SELECT *FROM {$this->tabela} c 
                          ORDER BY c.idAgendamento ASC");
        $this->result['cliente'] = $listar->getResult();
        return $this->result['cliente'];
    }

    public function listarUmAtendimento($id){
        $listar = new \Site\models\helper\ModelsRead();
        $listar->exeReadEspecifico("SELECT c.*, h.*
                                    FROM {$this->tabela} c INNER JOIN horario h
                                        ON c.horario = h.idHorario
                                    WHERE c.idAtendimento = :id", "id=$id");
        $this->result['cliente'] = $listar->getResult(); 
        return $this->result['cliente'];
    }

    public function agendamentoPorDataHora($data, $hora){
        $listar = new \Site\models\helper\ModelsRead();
        $listar->exeReadEspecifico("SELECT a.idAtendimento agendamento, a.cliente solicitado
                                    FROM {$this->tabela} a
                                    WHERE a.data = :data AND a.horario = :horario", "data=$data&horario=$hora");
        $this->result['agendamentoPorDataHora'] = $listar->getResult();
        return $this->result['agendamentoPorDataHora'];
    }

    public function agendamentosPorFuncionario($func){ 
        $listar = new \Site\models\helper\ModelsRead();
        $listar->exeReadEspecifico("SELECT a.*
                                    FROM {$this->tabela} a INNER JOIN horario h ON h.idHorario=a.horario INNER JOIN funcionario f ON f.idFunc = h.funcHorario
                                    WHERE f.idFunc = :idFunc
                                    GROUP BY a.data
                                    ORDER BY a.idAtendimento ASC", "idFunc=$func");
        $this->result['agendamentosPorFuncionario'] = $listar->getResult();
        return $this->result['agendamentosPorFuncionario'];
    }

    public function agendar(array $dados){
        $this->dados = $dados;
        $this->validarDados();
        if ($this->result){
            $this->exeAgendamento(); 
        }
    }

    private function validarDados(){
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        if (in_array('', $this->dados)){
            $_SESSION['msg'] = "
                    <div class='msg'>
                        <div class='alert alert-danger col-md-6 col-sm-10' role='alert'>
                          <strong>Erro ao enviar:</strong> Favor, preencha todos os campos!
                        </div>
                    </div>"; 
        }else{
            $this->result = true; 
        }
    }

    private function exeAgendamento(){
        unset($this->dados['funcionario']); 
        $this->dados['cliente'] = $_SESSION['idCliente'];
        $this->dados['horario'] = $this->dados['horarios'];
        $this->dados['data'] = $this->dados['datas'];

        unset($this->dados['datas']);
        unset($this->dados['horarios']);

        $cadastrar = new \Site\models\helper\ModelsCreate(); 
        $cadastrar->exeCreate('atendimento', $this->dados);

        if($cadastrar->getResult()){
            $_SESSION['msg'] = "<div class='msg'>
                                    <div class=\"alert alert-success col-md-8 col-sm-10\" role=\"alert\" style='margin-left:'>
                                        <p>Agendamento Realizado! Fique atento caso queira cancelar pois há um período limite de até 2 horas antes do horario marcado!<p>
                                        <p>Você também pode receber propostas para ceder seu horário à outras pessoas. Caso esteja de acordo, você pode aceitar a situação, se não, poderá nega-la.
                                    </div>
                                </div>";
        }
    }
 
    public function getResult(){
        return $this->result;
    }

    public function cancelarAtendimento(array $dados){
        $this->dados = $dados;
        $this->validarDadosCancelar();
        if($this->result){
            $this->exeCancelarAtendimento();
        }
    }


    private function validarDadosCancelar(){
        $listarAtendimento = new Agendamento();
        $atendimento = $listarAtendimento->listarUmAtendimento($this->dados['btnCancelar']);
        $horaAtual = date("H:i");
        $dataAtual = date("Y-m-d");
        $tempoFaltando =  $atendimento[0]['horarioReal'] - $horaAtual;
        if($dataAtual == $atendimento[0]['data']){
            if($tempoFaltando >= 2){
                $this->result = true;
            }else{
                $this->result = false;
                $_SESSION['msg'] = "<div class='msg'>
                                        <div class=\"alert alert-success col-md-8 col-sm-10\" role=\"alert\" style='margin-left:'>
                                            <p>O atendimento selecionado não pode ser cancelado pois excedeu o periodo de cancelamento!
                                        </div>
                                    </div>";
            }
        }else if($dataAtual < $atendimento[0]['data']){
            $this->result = true;
        }else{
            $this->result = false;
            $_SESSION['msg'] = "<div class='msg'>
                                    <div class=\"alert alert-success col-md-8 col-sm-10\" role=\"alert\" style='margin-left:'>
                                        <p>O atendimento selecionado não pode ser cancelado pois ele já ocorreu, burro!
                                    </div>
                                </div>";            
        }
    } 

    private function exeCancelarAtendimento(){
        $cancelar = new \Site\models\helper\ModelsDelete();
        $cancelar->exeDelete("atendimento", "WHERE idAtendimento =:id", "id={$this->dados['btnCancelar']}");
        if($cancelar->getResult()){
            $_SESSION['msg'] = "<div class='msg'>
                                    <div class=\"alert alert-success col-md-3 col-sm-10\" role=\"alert\" style='margin-left:'>
                                        Cancelamento Sucedido!
                                    </div>
                                </div>";
        }else{
            $_SESSION['msg'] = "<div class='msg'>
                                    <div class='alert alert-danger col-md-6 col-sm-10' role='alert'>
                                      Erro ao cancelar
                                    </div>
                                </div>";
        }
    }
}  