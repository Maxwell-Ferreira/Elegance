<?php

namespace App\adm\models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Servico{

    private $result;
    private $limiteResultado = 40;
    private $id;
    private $dados;
    private $foto;

    
    public function listarServico(){
        $listarUsuario = new \App\adm\Models\helper\ModelsRead();
        $listarUsuario->exeReadEspecifico("SELECT *
                                            FROM servico
                                            ORDER BY idServico ASC");
        $this->result = $listarUsuario->getResult();
        return $this->result;
    }

    public function verServico($id = null){
        $this->id = (string) $id;
        $listarUsuario = new \App\adm\Models\helper\ModelsRead();
        $listarUsuario->exeReadEspecifico("SELECT *
                                            FROM servico
                                            WHERE idServico = :id", "id={$this->id}");
        $this->result = $listarUsuario->getResult();
        return $this->result;
    }

    function getResult()
    {
        return $this->result;
    }

    public function confirmarServico(){
        $verServico = new \App\adm\Models\helper\ModelsRead();
        $verServico->exeReadEspecifico("SELECT idServico, imagemServico
                                        FROM servico
                                        WHERE idServico = :id", "id={$this->id}");
        $this->dados = $verServico->getResult();
    }

    public function apagarServico($id = null)
    {
        $this->id = (int) $id;
        $this->confirmarServico();
        if ($this->dados) {
            $apagarServico = new \App\adm\Models\helper\ModelsDelete();
            $apagarServico->exeDelete("servico", "WHERE idServico =:id", "id={$this->id}");
            if ($apagarServico->getResult()) {
                $apagarImg = new \App\adm\Models\helper\ModelsDelete();
                $apagarImg->apagarImg('assets/img/servicos/'. $this->dados[0]['imagemServico'], 'assets/img/servicos/');
                $_SESSION['msg'] = "<div class='alert alert-success'>Serviço excluído com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O serviço não foi apagado!</div>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Serviço não existe!</div>";
            $this->result = false;
        }
    }


    public function cadServico(array $dados){
        $this->dados = $dados;

        $this->foto = $this->dados['imagemServico'];
        unset($this->dados['imagemServico']);

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
        $valServico = new \App\adm\Models\helper\ModelsRead();
        $valServico->exeReadEspecifico("SELECT idServico FROM servico WHERE descServico =:servico LIMIT :limit", "servico={$this->dados['descServico']}&limit=1");
        $result = $valServico->getResult();

        if(!empty($result)){
        	$_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este serviço já está cadastrado!</div>";
            $this->result = false;
        }else{
        	$this->inserirServico();
        }
    }

    private function inserirServico()
    {
    	$slugImg = new \App\adm\Models\helper\ModelsSlug(); 
        $this->dados['imagemServico'] = $slugImg->nomeSlug($this->foto['name']);

        $cadServico = new \App\adm\models\helper\ModelsCreate();
        $cadServico->exeCreate("servico", $this->dados);
        if ($cadServico->getResult()) {
            if (empty($this->foto['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Serviço cadastrado com sucesso!</div>";
                $this->result = true;
            } else {
                $this->valFoto();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O serviço não foi cadastrado!</div>";
            $this->result = false;
        }
    }

    private function valFoto()
    {
        $uploadImg = new \App\adm\models\helper\ModelsUploadImg();
        $uploadImg->uploadImagem($this->foto, 'assets/img/servicos/', $this->dados['imagemServico']);
        if ($uploadImg->getResult()) { 
            $_SESSION['msg'] = "<div class='alert alert-success'>Serviço cadastrado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O servico não foi cadastrado!</div>";
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

    public function altServico(array $dados)
    {
        $this->dados = $dados;
        $this->foto = $this->dados['imagemServico'];
        unset($this->dados['imagemServico']);

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
        $valServico = new \App\adm\Models\helper\ModelsRead();
        $valServico->exeReadEspecifico("SELECT idServico FROM servico WHERE descServico =:servico AND idServico <> :id LIMIT :limit", "servico={$this->dados['descServico']}&id={$this->dados['idServico']}&limit=1");
        $result = $valServico->getResult();

        if (!empty($result)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este serviço já está cadastrado!</div>";
            $this->result = false;
        } else {
            $this->valFotoAlterar();
        }
    }

    private function valFotoAlterar()
    {
        if (empty($this->foto['name'])) {
            $this->dados['imagemServico'] = $this->foto;
            $this->updateEditServico();
        } else {
            $slugImg = new \App\adm\models\helper\ModelsSlug();
            $this->dados['imagemServico'] = $slugImg->nomeSlug($this->foto['name']);

            $uploadImg = new \App\adm\models\helper\ModelsUploadImg();
            $uploadImg->uploadImagem($this->foto, 'assets/img/servicos/', $this->dados['imagemServico']);
            $this->updateEditServico();
        }
    }

    private function updateEditServico()
    { 
        $upServico = new \App\adm\Models\helper\ModelsUpdate();
        $upServico->exeUpdate("servico", $this->dados, "WHERE idServico =:id", "id=" . $this->dados['idServico']);
        if ($upServico->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Serviço atualizado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O serviço não foi atualizado!</div>";
            $this->result = false;
        }
    }


}
