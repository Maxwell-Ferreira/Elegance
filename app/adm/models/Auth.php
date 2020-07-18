<?php

namespace App\adm\models;

if (!defined('URL')){
    header("location: /");
    exit();
}

class Auth {

    private $dados;
    private $result;
    private $msg;
    private $rowCount;

    public function autenticar(array $dados) {
        $this->dados = $dados;
        $this->validar();
        if ($this->result){
            $validarAcesso = new \App\adm\models\helper\ModelsRead();
            $validarAcesso->exeReadEspecifico("SELECT adm.*
                                                FROM useradm adm
                                                WHERE adm.loginAdm = :usuario", "usuario={$this->dados['user']}");
            $this->result = $validarAcesso->getResult();
            if ($validarAcesso->getRowCount() == 1) {
                $this->validarSenha();
            }else {
                $this->result = false;
                $this->msg = "
                        <div class='alert alert-danger' role='alert'>
                          Login e/ou senhas incorretos!
                        </div>
                        ";
            }
        }
    }

    public function validar(){
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        if (in_array('', $this->dados)){
            $this->result = false;
            $this->msg = "
                        <div class='alert alert-danger' role='alert'>
                          Login e/ou senhas incorretos!
                        </div>
                        ";
        }else{
            $this->result = true;
        }
    }

    private function validarSenha(){
        if (md5($this->dados['senha']) == $this->result[0]['senhaAdm']) {
            $_SESSION['idAdm'] = $this->result[0]['idAdm'];
            $_SESSION['loginAdm'] = $this->result[0]['loginAdm'];
            $_SESSION['senhaAdm'] = $this->result[0]['senhaAdm'];
            $_SESSION['nomeAdm'] = $this->result[0]['nomeAdm'];
            $this->result = true;
        } else {
            $this->msg = "<div class='alert alert-danger'>Erro: Usuário ou a senha incorreto!</div>";
            $this->result = false;
        }
    }

    function getResult() {
        return $this->result;
    }

    function getMsg() {
        return $this->msg;
    }

    function getRowCount() {
        return $this->rowCount;
    }

}
