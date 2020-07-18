<?php

namespace App\adm\controllers;

if (!defined('URL')){
    header("location: /");
    exit();
}

class AdmFunc {
    private $dados;
    private $id;

    public function index() {
        $botao = ['cad_usuario' => true,
            'edit_usuario' => true,
            'del_usuario' => true,
            'mostrar_horarios' => true];
        
        $this->dados['botao'] = $botao; 

        $listarFunc = new \App\adm\models\Funcionario(); 
        $this->dados['listFunc'] = $listarFunc->listarFunc();

        $carregarView = new \Config\ConfigView("funcionarios/index", $this->dados);
        $carregarView->renderizarAdm();
    }

    public function addFunc(){
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['CadFunc'])) {
            unset($this->dados['CadFunc']);
            $this->dados['fotoFunc'] = ($_FILES['fotoFunc'] ? $_FILES['fotoFunc'] : null);

            $CadFunc = new \App\adm\Models\Funcionario();
            $CadFunc->CadFunc($this->dados);
            if ($CadFunc->getResult()) {
                $urlDestino = URL . 'adm-func/index';
                header("Location: $urlDestino");
            }
        }

        $listarServico = new \App\adm\models\Servico(); 
        $this->dados['listServico'] = $listarServico->listarServico();

        $carregarView = new \Config\ConfigView("funcionarios/addFunc", $this->dados);
        $carregarView->renderizarAdm();
    }

    public function upFunc($dadosId = null)
    {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dadosId = (int) $dadosId;
        if (!empty($this->dadosId)) {
            $this->upFuncPriv(); 
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Funcionario não encontrado!</div>";
            $urlDestino = URL . 'adm-func/index';
            header("Location: $urlDestino");
        }
    }

    private function upFuncPriv()
    {
        if (!empty($this->dados['upFunc'])){
            unset($this->dados['upFunc']);
            $this->dados['fotoFunc'] = ($_FILES['fotoFunc'] ? $_FILES['fotoFunc'] : null);

            if(empty($_FILES['fotoFunc']['name'])){
                $this->dados['fotoFunc'] = $this->dados['imagemAntiga'];
            }
            unset($this->dados['imagemAntiga']);
            
            $editarFunc = new \App\adm\models\Funcionario();
            $editarFunc->altFunc($this->dados);
            if ($editarFunc->getResult()) {
                $urlDestino = URL . 'adm-func/index';
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dados;

                $listarServico = new \App\adm\models\Servico(); 
                $this->dados['listServico'] = $listarServico->listarServico();

                $carregarView = new \Config\ConfigView("funcionarios/upFunc", $this->dados);
                $carregarView->renderizarAdm();
            }
        } else {
            $listarServico = new \App\adm\models\Servico(); 
            $this->dados['listServico'] = $listarServico->listarServico();

            $verUsuario = new \App\adm\models\Funcionario();
            $this->dados['form'] = $verUsuario->verFunc($this->dadosId);

            $carregarView = new \Config\ConfigView("funcionarios/upFunc", $this->dados);
            $carregarView->renderizarAdm();
        }
    }

    public function delFunc($id = null){
        $this->id = (int) $id;
        if (!empty($this->id)){
            $apagarFunc = new \App\adm\Models\Funcionario();
            $apagarFunc->apagarFunc($this->id);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um funcionário!</div>";
        }
        $urlDestino = URL . 'adm-func/index';
        header("Location: $urlDestino");
    }

    public function horariosFunc($id = null){
        $this->id = (int) $id;
        if(!empty($this->id)){
            $this->dados['idFunc'] = $this->id;
            $listarHorario = new \App\adm\models\Horario(); 
            $this->dados['listHorario'] = $listarHorario->listarHorariosFunc($this->id);

            $carregarView = new \Config\ConfigView("funcionarios/horariosFunc", $this->dados);
            $carregarView->renderizarAdm();
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um funcionário!</div>";
            $urlDestino = URL . 'adm-func/index';
        header("Location: $urlDestino");
        }
    }

    public function addHorarioFunc($id){
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados['funcHorario'] = $id;
        if(!empty($this->dados['cadHorario'])){
            unset($this->dados['cadHorario']);

            $cadHorario = new \App\adm\models\Horario();
            $cadHorario->cadHorarioFunc($this->dados);
        }
        $duracao = new \App\adm\models\Horario(); 
        $this->dados['form'] = $duracao->verDuracao($this->dados['funcHorario']);

        $carregarView = new \Config\ConfigView("funcionarios/addHorario", $this->dados);
        $carregarView->renderizarAdm();
    }
}
