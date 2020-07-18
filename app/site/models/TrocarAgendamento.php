<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /"); 
    exit();
}

class TrocarAgendamento{

	private $tabela = 'atendimento'; 
    private $result = false;
    private $dadosTroca;
    private $dadosNot;

    public function solicitar(array $dados){
        $this->dados = $dados;
        $this->validarDados();
        if ($this->result){
            $this->exeSolicitar(); 
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

    private function exeSolicitar(){
    	$agendamento = new \Site\models\Agendamento();
    	$umAgendamento = $agendamento->agendamentoPorDataHora($this->dados['datas2'], $this->dados['horarios2']);

    	$umAgendamento[0]['solicitante'] = $_SESSION['idCliente'];
    	$umAgendamento[0]['notificacao'] = "Alguem deseja solicita seu horario do serviço";
        $umAgendamento[0]['statusNot'] = 0;

        $solicitar = new \Site\models\helper\ModelsCreate(); 
        $solicitar->exeCreate('notificacao', $umAgendamento[0]);

        if($solicitar->getResult()){
            $_SESSION['msg'] = "<div class='msg'>
                                    <div class=\"alert alert-success col-md-8 col-sm-10\" role=\"alert\" style='margin-left:'>
                                        <p>Foi enviada uma notificação para o dono desse agendamento!</p>
                                    </div>
                                </div>";
        }
    }
 
    public function getResult(){
        return $this->result;
    }

    public function trocarAtendimento($dados){
        $this->dados = $dados;
        $this->prepararDadosTroca();
        $this->exeTrocarAtendimento();
    }

    private function prepararDadosTroca(){
        $partes = explode("/", $this->dados);
        $this->dadosTroca['idAtendimento'] = $partes[0];
        $this->dadosTroca['cliente'] = $partes[2];

        $this->dadosNot['idnot'] = $partes[1];
        $this->dadosNot['statusNot'] = 1;
    }

    private function exeTrocarAtendimento(){
        $trocar = new \Site\models\helper\ModelsUpdate();
        $trocar->exeUpdate($this->tabela, $this->dadosTroca, "WHERE idAtendimento =:id", "id=" . $this->dadosTroca['idAtendimento']);
        $trocar->exeUpdate("notificacao", $this->dadosNot, "WHERE idnot =:id", "id=" . $this->dadosNot['idnot']);
    }

    public function cancelarTroca($dados){
        $this->dados = $dados;
        $this->prepararDadosCancelar();
        $this->exeCancelarTroca();
    }

    private function prepararDadosCancelar(){
        $this->dadosNot['idnot'] = $this->dados;
        $this->dadosNot['statusNot'] = 2;
    }

    private function exeCancelarTroca(){
        $cancelar = new \Site\models\helper\ModelsUpdate();
        $cancelar->exeUpdate("notificacao", $this->dadosNot, "WHERE idnot =:id", "id=" . $this->dadosNot['idnot']);
    }
}