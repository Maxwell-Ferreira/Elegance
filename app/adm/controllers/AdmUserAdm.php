<?php

namespace App\adm\controllers;

if (!defined('URL')){
    header("location: /"); 
    exit();
}

class AdmUserAdm {
    private $dados;
    private $id;

    public function index() {
        $botao = ['cad_usuario' => true,
            'edit_usuario' => true,
            'del_usuario' => true];
        
        $this->dados['botao'] = $botao; 

        $listarUsario = new \App\adm\models\UserAdm(); 
        $this->dados['listAdm'] = $listarUsario->listarAdm();

        $carregarView = new \Config\ConfigView("useradm/index", $this->dados);
        $carregarView->renderizarAdm();
    }

    public function addAdm(){
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['CadAdm'])){
            unset($this->dados['CadAdm']);
            $cadUsuario = new \App\adm\Models\UserAdm();
            $cadUsuario->cadAdm($this->dados);
            if ($cadUsuario->getResult()) {
                $urlDestino = URL . 'adm-userAdm/index';
                header("Location: $urlDestino");
            }
        }
        $carregarView = new \Config\ConfigView("UserAdm/addAdm", $this->dados);
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

    public function upAdm($dadosId = null){ 
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadosId = (int) $dadosId;
        if (!empty($this->dadosId)) {
            $this->upUserPriv(); 
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário não encontrado!</div>";
            $urlDestino = URL . 'adm-userAdm/index';
            header("Location: $urlDestino");
        }
    }

    private function upUserPriv()
    {
        if (!empty($this->dados['editAdm'])){
            unset($this->dados['editAdm']);
            $editarUsuario = new \App\adm\models\UserAdm();
            $editarUsuario->altAdm($this->dados);
            if ($editarUsuario->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Usuário editado com sucesso!</div>";
                $urlDestino = URL . 'adm-userAdm/index';
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dados;
                $carregarView = new \Config\ConfigView("useradm/upUser", $this->dados);
                $carregarView->renderizarAdm();
            }
        } else {
            $verUsuario = new \App\adm\models\UserAdm();
            $this->dados['form'] = $verUsuario->verAdm($this->dadosId);

            $carregarView = new \Config\ConfigView("useradm/upAdm", $this->dados);
            $carregarView->renderizarAdm();
        }
    }

    private function upUserViewPriv()
    {
        if ($this->dados['form']) {
            $listarSelect = new \App\adm\models\User();
            $this->dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_usuario' => true];            
            $this->dados['botao'] = $botao;

            $carregarView = new \Config\ConfigView("user/upUser", $this->dados);
            $carregarView->renderizarAdm();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário não encontrado!</div>";
            $UrlDestino = URL . 'user/index';
            header("Location: $UrlDestino");
        }
    }

    public function delAdm($id = null){
        $this->id = (int) $id;
        if (!empty($this->id)){
            $apagarUsuario = new \App\adm\Models\UserAdm();
            $apagarUsuario->apagarAdm($this->id);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um usuário!</div>";
        }
        $urlDestino = URL . 'adm-userAdm/index';
        header("Location: $urlDestino");
    }


    public function moreUser($id = null)
    {

        $this->id = (int) $id;
        if (!empty($this->id)) {
            $verUsuario = new \App\adm\Models\User();
            $this->dados['dados_usuario'] = $verUsuario->verUsuario($this->id);

            $botao = ['list_usuario' => true,
                'edit_usuario' => true,
                'edit_senha' => true,
                'del_usuario' => true];            
            $this->dados['botao'] = $botao;           

            $carregarView = new \Config\ConfigView("user/moreUser", $this->dados);
            $carregarView->renderizarAdm();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário não encontrado!</div>";
            $urlDestino = URL . 'adm-user/index';
            header("Location: $urlDestino");
        }
    }
	
	public function upUserPass($dadosId = null){
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadosId = (int) $dadosId;
        if (!empty($this->dadosId)) {
            $validaUsuario = new \App\adm\models\ModelsUpPass();
            $validaUsuario->valUsuario($this->dadosId);
            if ($validaUsuario->getResult()) {
                $this->upPassPriv();
            } else {
                $urlDestino = URL . 'adm-user/index';
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário não encontrado!</div>";
            $UrlDestino = URL . 'adm-user/index';
            header("Location: $UrlDestino");
        }
    }

    private function upPassPriv(){
        if (!empty($this->dados['EditSenha'])) {
            unset($this->dados['EditSenha']);
            $editarSenha = new \App\adm\Models\ModelsUpPass();
            $editarSenha->editSenha($this->dados);
            if ($editarSenha->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Senha editada com sucesso!</div>";
                $urlDestino = URL . 'adm-user/moreUser/' . $this->dados['id'];
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dados['id'];
                $this->upPassViewPriv();
            }
        } else {
            $this->dados['form'] = $this->dadosId;
            $this->upPassViewPriv();
        }
    }

    private function upPassViewPriv()
    {
        if ($this->dados['form']) {
            $botao = ['vis_usuario' => true];            
            $this->dados['botao'] = $botao;


            $carregarView = new \Config\ConfigView("user/upUserPass", $this->dados);
            $carregarView->renderizarAdm();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário não encontrado!</div>";
            $urlDestino = URL . 'adm-user/index';
            header("Location: $urlDestino");
        }
    }

}
