<?php

namespace App\site\controllers;

 if (!defined('URL')){
     header("location: /");
     exit();
 }

class Home {
     private $dados;

    public function index() {

        $listar = new \Site\Models\Carousel();
        $this->dados['carousel'] = $listar->listar();

        $listar = new \Site\Models\ImagensHome();
        $this->dados['imagensHome'] = $listar->listar();

        $listar = new \Site\Models\PerguntasFrequentes();
        $this->dados['perguntas_frequentes'] = $listar->listar();

        $listar = new \Site\Models\Logos();
        $this->dados['logos'] = $listar->listar();

        if(isset($_SESSION['idCliente'])){
            $listar = new \Site\Models\Notificacao();
            $this->dados['notificacao'] = $listar->listarNotUser($_SESSION['idCliente']);

            if(!empty($this->dados['btnAceitarTroca'])){
                $trocar = new \Site\Models\TrocarAgendamento();
                $trocar->trocarAtendimento($this->dados['btnAceitarTroca']);
                header("Location: ".URL."perfil/index");
            }
        }
        
        $carregarView = new \Config\ConfigView("home/index", $this->dados);
        $carregarView->renderizar();
    }
 
}
