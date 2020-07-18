<?php

namespace App\site\controllers;

 if (!defined('URL')){
     header("location: /"); 
     exit();
 }
 
class Login {
     private $dados;

    public function index() {

    	$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    	if (!empty($this->dados['login'])) {

            unset($this->dados['login']);
            $logarCliente = new \Site\Models\Login();

            if(isset($this->dados['remember-me'])){
                unset($this->dados['remember-me']);
            }
            if(isset($this->dados['mostrar-senha'])){
                unset($this->dados['mostrar-senha']);
            }

            if($logarCliente->logarCliente($this->dados)){
            	$this->dados['formRetorno'] = null;
            	$urlDestino = URL.'home/index';
            	header("location: $urlDestino");

            }else{
            	$this->dados['senhaCliente'] = '';
                $this->dados['formRetorno'] = $this->dados; 
            }
        }

        $listar = new \Site\Models\Logos();
        $this->dados['logos'] = $listar->listar();

        $carregarView = new \Config\ConfigView("login/index", $this->dados);
        $carregarView->renderizar();
    }

    public function logout() {

        session_unset();

        header("location: ".URL."home/index");
    }  
}
