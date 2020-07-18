<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /"); 
    exit();
}


class Cadastro{

    private $tabela = 'cliente';
    private $result = false; 

    public function listar(){
        $listar = new \Site\models\helper\ModelsRead();
        $listar->exeReadEspecifico("SELECT *FROM {$this->tabela} c 
                          ORDER BY c.idCliente ASC");
        $this->result['cliente'] = $listar->getResult();
        return $this->result['cliente'];
    } 

    public function addCliente(array $dados){
        $this->dados = $dados;
        $this->validarDados();
        if ($this->result){
            $this->exeAddCliente(); 
        }
    }

    private function validarDados(){
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        if (in_array('', $this->dados)){
            $_SESSION['msg'] = "
                    <div class='msg'>
                        <div class='alert alert-danger col-md-6 col-sm-10' role='alert'>
                          <strong>Erro ao enviar:</strong> Os campos obrigatórios não foram preenchidos!
                        </div>
                    </div>";
        }else{
            if (filter_var($this->dados['emailCliente'], FILTER_VALIDATE_EMAIL)){
                $carregar = new Cadastro();
                $resultado['cliente'] = $carregar->listar();
                $count = true;
                $senha = '';
                foreach($resultado['cliente'] as $clientes){
                    if($this->dados['emailCliente'] == $clientes['emailCliente']){
                        $count = false;
                        break;
                    }
                }
                if($count){
                    $this->result = true;
                    /* $_SESSION['idCliente'] = ;
                     $_SESSION['senhaCliente'] = $this->dados['senhaCliente']; 
                     $_SESSION['emailCliente'] = $this->dados['emailCliente'];
                     $_SESSION['nomeCliente'] = $this->dados['nomeCliente']; */
                }else{
                    $_SESSION['msg'] = "
                    <div class='msg'>
                        <div class='alert alert-danger col-md-6 col-sm-10' role='alert'>
                          <strong>Erro ao enviar:</strong> E-mail já cadastrado!
                        </div>
                    </div>";
                }
                
            }else{
                $_SESSION['msg'] = "
                    <div class='msg'>
                        <div class='alert alert-danger col-md-6 col-sm-10' role='alert'>
                          <strong>Erro ao enviar:</strong> O campo e-mail é inválido!
                        </div>
                    </div>";
            }

            if($this->dados['senhaCliente'] == $this->dados['confSenha']){
                $this->dados['senhaCliente'] = md5($this->dados['senhaCliente']);
                unset($this->dados['confSenha']);
            }else{
                 $_SESSION['msg'] = "
                    <div class='msg'>
                        <div class='alert alert-danger col-md-6 col-sm-10' role='alert'>
                          <strong>Erro ao enviar:</strong> As senhas não conferem!
                        </div>
                    </div>";
                    $this->result = false; 
            }
        }
    }


    private function exeAddCliente(){
        $inserir = new \Site\models\helper\ModelsCreate();
        $inserir->exeCreate($this->tabela, $this->dados);

        if ($inserir->getResult()){
            $this->result = true;
            $_SESSION['msg'] = "
                    <div class='msg'>
                        <div class=\"alert alert-success col-md-3 col-sm-10\" role=\"alert\" style='margin-left:'>
                            Cliente enviado com sucesso!
                        </div>
                    </div>";
        }else{
            $_SESSION['msg'] = "
                        <div class='msg'>
                            <div class=\"alert alert-danger col-md-4 col-sm-10\" role=\"alert\">
                                Cliente não enviado com sucesso! Erro: {$inserir->getMsg()}
                            </div>
                        </div>";
        }
    }

    public function getResult(){
        return $this->result;
    }
}

