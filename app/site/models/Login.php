<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /"); 
    exit();
}


class Login{

    private $tabela = 'cliente';
    private $result = false;

    public function listar(){
        $listar = new \Site\models\helper\ModelsRead();
        $listar->exeReadEspecifico("SELECT *FROM {$this->tabela} c 
                          ORDER BY c.idCliente ASC");
        $this->result['cliente'] = $listar->getResult();
        return $this->result['cliente'];
    } 

    public function logarCliente(array $dados){
        $this->dados = $dados;
        $this->validarDados();
        if ($this->result){
            //$this->exeLoginCliente();
            return $this->result;
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
            if(filter_var($this->dados['emailCliente'], FILTER_VALIDATE_EMAIL)){
                $carregar = new Login();
                $resultado['cliente'] = $carregar->listar();
                $senha = '';

                foreach($resultado['cliente'] as $clientes){
                    if($clientes['emailCliente'] == $this->dados['emailCliente']){
                        $this->result = true;
                        $senha = $clientes['senhaCliente']; 
                        break; 
                    }
                }

                if($this->result){
                    if($senha == md5($this->dados['senhaCliente'])){
                         $_SESSION['idCliente'] = $clientes['idCliente']; 
                         $_SESSION['senhaCliente'] = $this->dados['senhaCliente'];
                         $_SESSION['emailCliente'] = $clientes['emailCliente'];
                         $_SESSION['nomeCliente'] = $clientes['nomeCliente'];
                         
                    }else{
                        $this->result = false;
                        $_SESSION['msg'] = "
                            <div class='msg'>
                                <div class='alert alert-danger col-md-6 col-sm-10' role='alert'>
                                  <strong>Erro ao enviar:</strong> Email e/ou senha incorretos!
                                </div>
                            </div>";
                    }
                }else{
                    $_SESSION['msg'] = "
                        <div class='msg'>
                            <div class='alert alert-danger col-md-6 col-sm-10' role='alert'>
                              <strong>Erro ao enviar:</strong> Email e/ou incorretos!
                            </div>
                        </div>";
                }

                
            }else{
                $_SESSION['msg'] = "
                        <div class='msg'>
                            <div class='alert alert-danger col-md-6 col-sm-10' role='alert'>
                              <strong>Erro ao enviar:</strong> E-mail inválido!
                            </div>
                        </div>";
            }
        }
    }

    public function getResult(){
        return $this->result;
    }
}

