<?php

namespace App\adm\models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class UserAdm{

    private $result;
    private $limiteResultado = 40;
    private $id;
    private $dados;

    
    public function listarAdm(){
        $listarUsuario = new \App\adm\Models\helper\ModelsRead();
        $listarUsuario->exeReadEspecifico("SELECT *
                                            FROM useradm
                                            ORDER BY idAdm ASC");
        $this->result = $listarUsuario->getResult();
        return $this->result;
    }

    public function verAdm($id = null){
        $this->id = (string) $id;
        $listarUsuario = new \App\adm\Models\helper\ModelsRead();
        $listarUsuario->exeReadEspecifico("SELECT *
                                            FROM useradm
                                            WHERE idAdm = :id", "id={$this->id}");
        $this->result = $listarUsuario->getResult();
        return $this->result;
    }

    function getResult()
    {
        return $this->result;
    }

    public function confirmarUser(){
        $verUsuario = new \App\adm\Models\helper\ModelsRead();
        $verUsuario->exeReadEspecifico("SELECT idAdm
                                        FROM useradm
                                        WHERE idAdm = :id", "id={$this->id}");
        $this->dados = $verUsuario->getResult();
    }

    public function apagarAdm($id = null)
    {
        $this->id = (int) $id;
        $this->confirmarUser();
        if ($this->dados) {
            $apagarUsuario = new \App\adm\Models\helper\ModelsDelete();
            $apagarUsuario->exeDelete("useradm", "WHERE idAdm =:id", "id={$this->id}");
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


    public function cadAdm(array $dados){
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
        $valUsuario = new \App\adm\models\helper\ModelsValUsuario();
        $valUsuario->valUsuario($this->dados['loginAdm']);

        $valSenha = new \App\adm\models\helper\ModelsValSenha();
        $valSenha->valSenha($this->dados['senhaAdm'], $this->dados['conf-senha']);   

        if (($valSenha->getResult()) AND ( $valUsuario->getResult())) {
            unset($this->dados['conf-senha']);
            $this->inserirAdm();
        } else {
            $this->result = false;
        }
    }

    private function inserirAdm()
    {
        //$this->dados['senha'] = password_hash($this->dados['senha'], PASSWORD_DEFAULT);
        $this->dados['senhaAdm'] = md5($this->dados['senhaAdm']);
        $cadUsuario = new \App\adm\models\helper\ModelsCreate();
        $cadUsuario->exeCreate("useradm", $this->dados);
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

    public function altAdm(array $dados)
    {
        $this->dados = $dados;
        //var_dump($this->dados); exit();

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
        $valUsuario = new \App\adm\models\helper\ModelsValUsuario();
        $editarUnico = true;
        $valUsuario->valUsuario($this->dados['loginAdm'], $editarUnico, $this->dados['idAdm']);  

        $valSenha = new \App\adm\models\helper\ModelsValSenha();
        $valSenha->valSenha($this->dados['senhaAdm'], $this->dados['conf-senha']);

        if (($valSenha->getResult()) AND ( $valUsuario->getResult())) {
            unset($this->dados['conf-senha']);
            $this->updateEditAdm();
        } else {
            $this->result = false;
        }
    }

    private function updateEditAdm(){ 
        $this->dados['senhaAdm'] = md5($this->dados['senhaAdm']);
        $upAltSenha = new \App\adm\Models\helper\ModelsUpdate();
        $upAltSenha->exeUpdate("useradm", $this->dados, "WHERE idAdm =:id", "id=" . $this->dados['idAdm']);
        if ($upAltSenha->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário atualizado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O usuario não foi atualizado!</div>";
            $this->result = false;
        }
    }


}
