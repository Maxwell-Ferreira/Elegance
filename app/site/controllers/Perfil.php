<?php

namespace App\site\controllers;

 if (!defined('URL')){
     header("location: /");
     exit();
 }

class Perfil {
     private $dados; 

    public function index() { 

        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($this->dados['btnCancelar'])){
            $cancelar = new \Site\Models\Agendamento();
            $cancelar->cancelarAtendimento($this->dados);
            header("Location: ".URL."perfil/index");
        }
 
        $listar = new \Site\Models\Logos();
        $this->dados['logos'] = $listar->listar();

        $listar = new \Site\Models\Perfil();
        $this->dados['atendimentosPerfil'] = $listar->listarAtendimentosPerfil();

        $listar = new \Site\Models\Notificacao();
        $this->dados['notificacao'] = $listar->listarNotUser($_SESSION['idCliente']);

        if(!empty($this->dados['btnAceitarTroca'])){
            $trocar = new \Site\Models\TrocarAgendamento();
            $trocar->trocarAtendimento($this->dados['btnAceitarTroca']);
            header("Location: ".URL."perfil/index");
        }
        if(!empty($this->dados['btnCancelarTroca'])){
            $cancelar = new \Site\Models\TrocarAgendamento();
            $cancelar->cancelarTroca($this->dados['btnCancelarTroca']);
            header("Location: ".URL."perfil/index");
        }

        $carregarView = new \Config\ConfigView("perfil/index", $this->dados);
        $carregarView->renderizar();


    }

    public function alterarDados() {

        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($this->dados['alterar'])){
            unset($this->dados['alterar']);

            $this->dados['idCliente'] = $_SESSION['idCliente'];
            $altDados = new \Site\Models\AlterarDados();
            $altDados->altDados($this->dados); 
            if($altDados->getResult()){
                $_SESSION['idCliente'] = $this->dados['idCliente'];
                $_SESSION['emailCliente'] = $this->dados['emailCliente'];
                $_SESSION['nomeCliente'] = $this->dados['nomeCliente'];
                $_SESSION['senhaCliente'] = $this->dados['senhaCliente'];

                $urlDestino = URL.'perfil/index'; 
                header("location: $urlDestino");
            }
        } 

        $listar = new \Site\Models\Logos();
        $this->dados['logos'] = $listar->listar();

        $listar = new \Site\Models\Notificacao();
        $this->dados['notificacao'] = $listar->listarNotUser($_SESSION['idCliente']);

        $carregarView = new \Config\ConfigView("perfil/alterarDados", $this->dados);
        $carregarView->renderizar(); 
    }
} 
