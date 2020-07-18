<?php

namespace Site\models;

if (!defined('URL')){
    header("location: /"); 
    exit();
}


class AlterarDados{

    private $tabela = 'cliente';
    private $result = false;

    public function listar(){
    	$id = $_SESSION['idCliente'];

        $listar = new \Site\models\helper\ModelsRead();
        $listar->exeReadEspecifico("SELECT *FROM {$this->tabela} c 
                          WHERE c.idCliente <> :id
                          ORDER BY c.idCliente ASC", "id=$id");
        $this->result['cliente'] = $listar->getResult();
        return $this->result['cliente']; 
    } 

    public function altDados(array $dados){
        $this->dados = $dados;
        $this->validarDados();
        if ($this->result){
            $this->exeAltCliente(); 
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
            	if($this->dados['emailCliente'] == $_SESSION['emailCliente']){
            		$this->result = true;	
            	}else{
            		$carregar = new AlterarDados();
	                $resultado['cliente'] = $carregar->listar();
	                $count = true;
	                foreach($resultado['cliente'] as $clientes){
	                    if($this->dados['emailCliente'] == $clientes['emailCliente']){
	                        $count = false;
	                        break;
	                    }
	                }
	                if($count){
	                    $this->result = true;
	                }else{
	                    $_SESSION['msg'] = "
	                    <div class='msg'>
	                        <div class='alert alert-danger col-md-6 col-sm-10' role='alert'>
	                          <strong>Erro ao enviar:</strong> O e-mail informado já foi cadastrado!
	                        </div>
	                    </div>";
	                }
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


    private function exeAltCliente(){

        $alterar = new \Site\models\helper\ModelsUpdate();
        $alterar->exeUpdate($this->tabela, $this->dados, "WHERE idCliente =:id", "id=" . $this->dados['idCliente']);

        if ($alterar->getResult()){ 
            $this->result = true; 
            $_SESSION['msg'] = "
                    <div class='msg'>
                        <div class=\"alert alert-success col-md-3 col-sm-10\" role=\"alert\" style='margin-left:'>
                            Dados atualizados com sucesso!
                        </div>
                    </div>";
        }else{
            $_SESSION['msg'] = "
                        <div class='msg'>
                            <div class=\"alert alert-danger col-md-4 col-sm-10\" role=\"alert\">
                                Erro ao atualizar dados! Erro: {$inserir->getMsg()}
                            </div>
                        </div>"; 
        }
    }

    public function getResult(){
        return $this->result;
    }
}

 