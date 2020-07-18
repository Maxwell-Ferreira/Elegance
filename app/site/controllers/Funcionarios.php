<?php

namespace App\site\controllers;

 if (!defined('URL')){
     header("location: /");
     exit();
 }

class Funcionarios {
     private $dados;

    public function index() {

        $listar = new \Site\Models\Logos();
        $this->dados['logos'] = $listar->listar();

        $listar = new \Site\Models\Funcionario();
        $this->dados['funcionario'] = $listar->listar(); 

        $listar = new \Site\Models\Servico();
        $this->dados['servico'] = $listar->listar();  

        if(isset($_SESSION['idCliente'])){
            $listar = new \Site\Models\Notificacao();
            $this->dados['notificacao'] = $listar->listarNotUser($_SESSION['idCliente']); 

            if(!empty($this->dados['btnAceitarTroca'])){
                $trocar = new \Site\Models\TrocarAgendamento();
                $trocar->trocarAtendimento($this->dados['btnAceitarTroca']);
                header("Location: ".URL."perfil/index");
            }
        }

        $carregarView = new \Config\ConfigView("funcionarios/index", $this->dados); 
        $carregarView->renderizar();
    }
}
 