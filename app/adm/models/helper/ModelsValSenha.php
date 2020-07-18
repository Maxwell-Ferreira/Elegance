<?php

namespace App\adm\models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelsValSenha{

    private $senha;
    private $confSenha;
    private $result;

    function getResult()
    {
        return $this->result;
    }

    public function valSenha($senha, $confSenha)
    {
        $this->senha = (string) $senha;
        $this->confSenha  = (string) $confSenha;
        if (stristr($this->senha, "'")) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Caracter ( ' ) utilizado na senha inválido!</div>";
            $this->result = false;
        } else {
            if (stristr($this->senha, " ")) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Proibido utilizar espaço em branco no campo senha!</div>";
                $this->result = false;
            } else {
                $this->valTamSenha();
            }
        }
    }

    private function valTamSenha()
    {
        if($this->senha == $this->confSenha){
            if ((strlen($this->senha)) < 6) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A senha deve ter no mínimo 6 caracteres!</div>";
                $this->result = false;
            } else {
                $this->result = true;
            }
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A senhas não conferem!</div>";
            $this->result = false;
        }
    }

}
