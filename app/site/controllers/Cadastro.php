<?php

namespace App\site\controllers;

 if (!defined('URL')){
     header("location: /");
     exit();
 }

class Cadastro {
     private $dados;

    public function index() {

    	$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dados['cadastrar'])) {
            unset($this->dados['cadastrar']);
            $addCliente = new \Site\Models\Cadastro(); 
            $addCliente->addCliente($this->dados);
            $urlDestino = '';

            if (!$addCliente->getResult()){
                $this->dados['senhaCliente'] = '';
                $this->dados['confSenha'] = '';
                $this->dados['formRetorno'] = $this->dados;
            }else{
                $urlDestino = URL.'home/index';
                header("location: $urlDestino");  
            }
        }

        $listar = new \Site\Models\Logos();
        $this->dados['logos'] = $listar->listar();

        $carregarView = new \Config\ConfigView("cadastro/index", $this->dados);
        $carregarView->renderizar();
    }
}
