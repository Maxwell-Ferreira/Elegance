<?php

namespace App\adm\models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class User{

    private $result;
    private $limiteResultado = 40;
    private $id;
    private $dados;

    
    public function listarUsuario(){
        $listarUsuario = new \App\adm\Models\helper\ModelsRead();
        $listarUsuario->exeReadEspecifico("SELECT c.*
                                            FROM cliente c
                                            ORDER BY c.nomeCliente ASC");
        $this->result = $listarUsuario->getResult();
        return $this->result;
    }

    public function verUsuario($id = null){
        $this->id = (string) $id;
        $listarUsuario = new \App\adm\Models\helper\ModelsRead();
        $listarUsuario->exeReadEspecifico("SELECT c.*
                                            FROM cliente c
                                            WHERE c.idCliente = :id", "id={$this->id}");
        $this->result = $listarUsuario->getResult();
        return $this->result;
    }

    function getResult()
    {
        return $this->result;
    }

    public function confirmarUser(){
        $verUsuario = new \App\adm\Models\helper\ModelsRead();
        $verUsuario->exeReadEspecifico("SELECT c.idCliente
                                        FROM cliente c
                                        WHERE c.idCliente = :id", "id={$this->id}");
        $this->dados = $verUsuario->getResult();
    }

    public function apagarUsuario($id = null)
    {
        $this->id = (int) $id;
        $this->confirmarUser();
        if ($this->dados) {
            $apagarUsuario = new \App\adm\Models\helper\ModelsDelete();
            $apagarUsuario->exeDelete("cliente", "WHERE idCliente =:id", "id={$this->id}");
            if ($apagarUsuario->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Usuário excluído com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário não foi apagado!</div>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário não existe!</div>";
            $this->result = false;
        }
    }


    public function cadUsuario(array $dados){
        $this->dados = $dados;

        $valCampoVazio = new \App\adm\models\helper\ModelsCampoVazio();
        $valCampoVazio->validarDados($this->dados);

        if ($valCampoVazio->getResult()) {
            $this->valCampos();
        } else {
            $this->result = false;
        }
    }

    private function valCampos()
    {
        $valEmail = new \App\adm\models\helper\ModelsEmail();
        $valEmail->valEmail($this->dados['emailCliente']);

        $valEmailUnico = new \App\adm\Models\helper\ModelsEmailUnico();
        $valEmailUnico->valEmailUnico($this->dados['emailCliente']); 

        $valSenha = new \App\adm\models\helper\ModelsValSenha();
        $valSenha->valSenha($this->dados['senhaCliente'], $this->dados['conf-senha']);   

        if (($valSenha->getResult()) AND ( $valEmailUnico->getResult()) AND ( $valEmail->getResult())) {
            unset($this->dados['conf-senha']);
            $this->inserirUsuario();
        } else {
            $this->result = false;
        }
    }

    private function inserirUsuario()
    {
        //$this->dados['senha'] = password_hash($this->dados['senha'], PASSWORD_DEFAULT);
        $this->dados['senhaCliente'] = md5($this->dados['senhaCliente']);
        $cadUsuario = new \App\adm\models\helper\ModelsCreate();
        $cadUsuario->exeCreate("cliente", $this->dados);
        if ($cadUsuario->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O usuario não foi cadastrado!</div>";
            $this->result = false;
        }
    }

    private function valFoto()
    {
        $uploadImg = new \App\adm\models\helper\ModelsUploadImgRed();
        $uploadImg->uploadImagem($this->foto, 'assets/img/usuario/' . $this->dados['id'] . '/', $this->dados['imagem'], 150, 150);
        if ($uploadImg->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O usuario não foi cadastrado!</div>";
            $this->result = false;
        }
    }

    public function verFormCadUsuario()
    {
        $verFormCadUsuario = new \App\adm\models\helper\ModelsRead();
        $verFormCadUsuario->exeReadEspecifico("SELECT * FROM user
                WHERE id =:id LIMIT :limit", "id=1&limit=1");
        $this->result = $verFormCadUsuario->getResult();
        return $this->result;
    }

    public function altUsuario(array $dados)
    {
        $this->dados = $dados;
        //var_dump($this->Dados);

        $valCampoVazio = new \App\adm\models\helper\ModelsCampoVazio();
        $valCampoVazio->validarDados($this->dados);

        if ($valCampoVazio->getResult()) {
            $this->valCamposAlterar();
        } else {
            $this->result = false;
        }
    }

    private function valCamposAlterar()
    {
        $valEmail = new \App\adm\models\helper\ModelsEmail();
        $valEmail->valEmail($this->dados['emailCliente']);

        $valEmailUnico = new \App\adm\models\helper\ModelsEmailUnico();
        $editarUnico = true;
        $valEmailUnico->valEmailUnico($this->dados['emailCliente'], $editarUnico, $this->dados['idCliente']); 

        $valSenha = new \App\adm\models\helper\ModelsValSenha();
        $valSenha->valSenha($this->dados['senhaCliente'], $this->dados['conf-senha']);

        if (($valSenha->getResult()) AND ( $valEmailUnico->getResult()) AND ( $valEmail->getResult())) {
            unset($this->dados['conf-senha']);
            $this->updateEditUsuario();
        } else {
            $this->result = false;
        }
    }

    private function updateEditUsuario()
    { 
        $this->dados['senhaCliente'] = md5($this->dados['senhaCliente']);
        $upAltSenha = new \App\adm\Models\helper\ModelsUpdate();
        $upAltSenha->exeUpdate("cliente", $this->dados, "WHERE idCliente =:id", "id=" . $this->dados['idCliente']);
        if ($upAltSenha->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário atualizado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O usuario não foi atualizado!</div>";
            $this->result = false;
        }
    }


}
