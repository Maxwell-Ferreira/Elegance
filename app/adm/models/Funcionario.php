<?php

namespace App\adm\models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Funcionario{

    private $result;
    private $limiteResultado = 40;
    private $id;
    private $dados;
    private $foto;

    
    public function listarFunc(){
        $listarFunc = new \App\adm\Models\helper\ModelsRead();
        $listarFunc->exeReadEspecifico("SELECT f.*, f.nomeFunc, s.descServico
                                            FROM funcionario f INNER JOIN servico s
                                                ON s.idServico = f.servicoFunc 
                                            ORDER BY f.idFunc ASC");
        $this->result = $listarFunc->getResult();
        return $this->result;
    }

    public function verFunc($id = null){
        $this->id = (string) $id;
        $listarFunc = new \App\adm\Models\helper\ModelsRead();
        $listarFunc->exeReadEspecifico("SELECT *
                                            FROM funcionario
                                            WHERE idFunc = :id", "id={$this->id}");
        $this->result = $listarFunc->getResult();
        return $this->result;
    }

    function getResult()
    {
        return $this->result;
    }

    public function confirmarFunc(){
        $verFunc = new \App\adm\Models\helper\ModelsRead();
        $verFunc->exeReadEspecifico("SELECT idFunc, fotoFunc
                                        FROM funcionario
                                        WHERE idFunc = :id", "id={$this->id}");
        $this->dados = $verFunc->getResult();
    }

    public function apagarFunc($id = null)
    {
        $this->id = (int) $id;
        $this->confirmarFunc();
        if ($this->dados) {
            $apagarServico = new \App\adm\Models\helper\ModelsDelete();
            $apagarServico->exeDelete("funcionario", "WHERE idFunc =:id", "id={$this->id}");
            if ($apagarServico->getResult()) {
                if($this->dados[0]['fotoFunc'] != "padrao.png"){
                    $apagarImg = new \App\adm\Models\helper\ModelsDelete();
                    $apagarImg->apagarImg('assets/img/funcionarios/'. $this->dados[0]['fotoFunc'], 'assets/img/funcionarios/');
                }
                $_SESSION['msg'] = "<div class='alert alert-success'>Funcionario excluído com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O funcionario não foi apagado!</div>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Funcionario não existe!</div>";
            $this->result = false;
        }
    }


    public function cadFunc(array $dados){
        $this->dados = $dados;
        $this->foto = $this->dados['fotoFunc'];
        unset($this->dados['fotoFunc']);

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
        $this->valCpf();
        if(!empty($this->result)){
        	$_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Já existe um funcionario cadastrado com esse CPF!</div>";
            $this->result = false;
        }else{
        	$this->valFoto();
        }
    }

    private function valCpf(){
        if(empty($this->dados['idFunc'])){
            $valCpf = new \App\adm\Models\helper\ModelsRead();
            $valCpf->exeReadEspecifico("SELECT idFunc FROM funcionario WHERE cpfFunc =:cpf LIMIT :limit", "cpf={$this->dados['cpfFunc']}&limit=1");
        }else{
            $valCpf = new \App\adm\Models\helper\ModelsRead();
            $valCpf->exeReadEspecifico("SELECT idFunc FROM funcionario WHERE cpfFunc =:cpf AND idFunc <> :id LIMIT :limit", "cpf={$this->dados['cpfFunc']}&id={$this->dados['idFunc']}&limit=1");
        }
        
        $this->result = $valCpf->getResult();
    }

    private function valFoto(){
        if (empty($this->foto['name'])) {
            $this->dados['fotoFunc'] = 'padrao.png';
            $this->inserirFunc();
        } else {
            $slugImg = new \App\adm\models\helper\ModelsSlug();
            $this->dados['fotoFunc'] = $slugImg->nomeSlug($this->foto['name']);

            $uploadImg = new \App\adm\models\helper\ModelsUploadImg();
            $uploadImg->uploadImagem($this->foto, 'assets/img/funcionarios/', $this->dados['fotoFunc']);
            $this->inserirFunc();
        }
    }

    private function inserirFunc()
    {
        $cadFunc = new \App\adm\models\helper\ModelsCreate();
        $cadFunc->exeCreate("funcionario", $this->dados);
        if ($cadFunc->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Funcionário cadastrado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O funcionário não foi cadastrado!</div>";
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

    public function altFunc(array $dados)
    {
        $this->dados = $dados;
        $this->foto = $this->dados['fotoFunc'];
        unset($this->dados['fotoFunc']);

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
        $this->valCpf();
        if (!empty($this->result)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este cpf já está cadastrado para outro funcionário!</div>";
            $this->result = false;
        } else {
            $this->valFotoAlterar();
        }
    }

    private function valFotoAlterar()
    {
        if (empty($this->foto['name'])) {
            $this->dados['fotoFunc'] = $this->foto;
            $this->updateEditFunc();
        } else {
            $slugImg = new \App\adm\models\helper\ModelsSlug();
            $this->dados['fotoFunc'] = $slugImg->nomeSlug($this->foto['name']);

            $uploadImg = new \App\adm\models\helper\ModelsUploadImg();
            $uploadImg->uploadImagem($this->foto, 'assets/img/funcionarios/', $this->dados['fotoFunc']);
            $this->updateEditFunc();
        }
    }

    private function updateEditFunc()
    {
        $upFunc = new \App\adm\Models\helper\ModelsUpdate();
        $upFunc->exeUpdate("funcionario", $this->dados, "WHERE idFunc =:id", "id=" . $this->dados['idFunc']);
        if ($upFunc->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Funcionario atualizado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O funcionario não foi atualizado!</div>";
            $this->result = false;
        }
    }


}
