<?php

namespace App\adm\controllers;

if (!defined('URL')){
    header("location: /");
    exit();
}

class AdmServico {
    private $dados;
    private $id;

    public function index() {
        $botao = ['cad_usuario' => true,
            'edit_usuario' => true,
            'del_usuario' => true];
        
        $this->dados['botao'] = $botao; 

        $listarUsario = new \App\adm\models\Servico(); 
        $this->dados['listServico'] = $listarUsario->listarServico();

        $carregarView = new \Config\ConfigView("servicos/index", $this->dados);
        $carregarView->renderizarAdm();
    }

    public function addServico(){
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['CadServico'])) {
            unset($this->dados['CadServico']);
            $this->dados['imagemServico'] = ($_FILES['imagemServico'] ? $_FILES['imagemServico'] : null);
            $CadServico = new \App\adm\Models\Servico();
            $CadServico->CadServico($this->dados);
            if ($CadServico->getResult()) {
                $urlDestino = URL . 'adm-servico/index';
                header("Location: $urlDestino");
            }
        }
        $carregarView = new \Config\ConfigView("servicos/addServico", $this->dados);
        $carregarView->renderizarAdm();
    }

    private function addUserVerPriv()
    {
        $listarSelect = new \App\adm\Models\User();
        $this->dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_usuario' => true];        
        $this->dados['botao'] = $botao;
     
        $carregarView = new \Config\ConfigView("user/addUser", $this->dados);
        $carregarView->renderizarAdm();
    }

    public function upServico($dadosId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadosId = (int) $dadosId;
        if (!empty($this->dadosId)) {
            $this->upServPriv(); 
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário não encontrado!</div>";
            $urlDestino = URL . 'adm-servico/index';
            header("Location: $urlDestino");
        }
    }

    private function upServPriv()
    {
        if (!empty($this->dados['upServico'])){
            unset($this->dados['upServico']);
            $this->dados['imagemServico'] = ($_FILES['imagemServico'] ? $_FILES['imagemServico'] : null);

            if(empty($_FILES['imagemServico']['name'])){
                $this->dados['imagemServico'] = $this->dados['imagemAntiga'];
            }
            unset($this->dados['imagemAntiga']);
            
            $editarServico = new \App\adm\models\Servico();
            $editarServico->altServico($this->dados);
            if ($editarServico->getResult()) {
                $urlDestino = URL . 'adm-servico/index';
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dados;

                $carregarView = new \Config\ConfigView("servicos/upServico", $this->dados);
                $carregarView->renderizarAdm();
            }
        } else {
            $verUsuario = new \App\adm\models\Servico();
            $this->dados['form'] = $verUsuario->verServico($this->dadosId);

            $carregarView = new \Config\ConfigView("servicos/upServico", $this->dados);
            $carregarView->renderizarAdm();
        }
    }

    public function delServico($id = null){
        $this->id = (int) $id;
        if (!empty($this->id)){
            $apagarServico = new \App\adm\Models\Servico();
            $apagarServico->apagarServico($this->id);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um serviço!</div>";
        }
        $urlDestino = URL . 'adm-servico/index';
        header("Location: $urlDestino");
    }
}
