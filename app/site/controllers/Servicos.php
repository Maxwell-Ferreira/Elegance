<?php

namespace App\site\controllers;

 if (!defined('URL')){
     header("location: /");
     exit();
 }

class Servicos {
    private $dados;

    public function index() {

        $listar = new \Site\Models\Logos();
        $this->dados['logos'] = $listar->listar();

        $listar = new \Site\Models\Servico();
        $this->dados['servico'] = $listar->listar();

        $listar = new \Site\Models\Funcionario();
        $this->dados['funcionario'] = $listar->listar();        

        $listar = new \Site\Models\Horario();
        $this->dados['horario'] = $listar->listar(); 
 
        if(isset($_SESSION['idCliente'])){
            $listar = new \Site\Models\Notificacao();
            $this->dados['notificacao'] = $listar->listarNotUser($_SESSION['idCliente']);

            if(!empty($this->dados['btnAceitarTroca'])){
                $trocar = new \Site\Models\TrocarAgendamento();
                $trocar->trocarAtendimento($this->dados['btnAceitarTroca']);
                header("Location: ".URL."perfil/index");
            }
        }

        $carregarView = new \Config\ConfigView("servicos/index", $this->dados);
        $carregarView->renderizar();
    }
 
    public function agendarServico($idServico){ 

        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($this->dados['btnAgendar'])){
            unset($this->dados['btnAgendar']); 
            $agendar = new \Site\Models\Agendamento();
            $agendar->agendar($this->dados);

            if($agendar->getResult()){
                header("Location: ".URL."perfil/index?swall=swall");
            }
        }

        $vizualizarServico = new \Site\Models\Servico(); 
        $this->dados['servico'] = $vizualizarServico->vizualizarServico($idServico);

        $listar = new \Site\Models\Funcionario();
        $this->dados['funcionarios'] = $listar->listarFuncionariosServico($idServico);

        $listar = new \Site\Models\Notificacao();
        $this->dados['notificacao'] = $listar->listarNotUser($_SESSION['idCliente']);

        if(!empty($this->dados['btnAceitarTroca'])){
            $trocar = new \Site\Models\TrocarAgendamento();
            $trocar->trocarAtendimento($this->dados['btnAceitarTroca']);
            header("Location: ".URL."perfil/index");
        }

        $carregarView = new \Config\ConfigView("servicos/agendarServico", $this->dados); 
        $carregarView->renderizar(); 
    }

    public function agendarTrocarServico($idServico){
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($this->dados['btnAgendar'])){
            unset($this->dados['btnAgendar']);

            $trocar = new \Site\Models\TrocarAgendamento();
            $trocar->solicitar($this->dados);

            if($trocar->getResult()){
                header("Location: ".URL."perfil/index");
            }
        }
        
        $parametros = explode("a", $idServico);

        $vizualizarServico = new \Site\Models\Servico(); 
        $this->dados['servico'] = $vizualizarServico->vizualizarServico($parametros[0]);

        $listar = new \Site\Models\Funcionario();
        $this->dados['funcionarios'] = $listar->listarFuncionariosServico($parametros[0]);

        $listar = new \Site\Models\Notificacao();
        $this->dados['notificacao'] = $listar->listarNotUser($_SESSION['idCliente']);

        if(!empty($this->dados['btnAceitarTroca'])){
            $trocar = new \Site\Models\TrocarAgendamento();
            $trocar->trocarAtendimento($this->dados['btnAceitarTroca']);
            header("Location: ".URL."perfil/index");
        }

        $carregarView = new \Config\ConfigView("servicos/agendarTrocarServico", $this->dados); 
        $carregarView->renderizar(); 
    }
}
