<?php

if (!defined('URL')){ 
    header("location: /");
    exit();
}
?> 
<main role="main">

    <div style="text-align: center">
        <?php
            $logo = "";
                foreach ($this->dados['logos'] as $logos) {
                extract($logos);

                    if($id == 1){
                        $logo = $imagem;
                    }
              }
        ?>
        <img src="<?= URL. 'assets/img/logo/'.$logo; ?>" id="logo-login">
    </div>


    <?php
        if (isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if (!isset($this->dados['formRetorno'])){
             $nomeCliente = $emailCliente = $senhaCliente = $confSenha = "";
        }else {
            extract($this->dados['formRetorno']);
        }
    ?>  
     
     <div id="cadastro">
        <div class="container">
            <div id="cadastro-row" class="row justify-content-center align-items-center">
                <div id="cadastro-column" class="col-md-6">
                    <div id="cadastro-box" class="col-md-12 " style="box-shadow: 0px 0px 15px black;">
                        <form id="cadastro-form" class="form" action="" method="post" style="margin-top: 10px">
                            <div class="form-group">
                                <label for="nome" class="text-white">Nome completo:</label><br>
                                <input type="text" name="nomeCliente" id="nome" class="form-control" value="<?= $nomeCliente ?>">
                            </div>
                            <div class="form-group">
                               <label for="email" class="text-white">Email:</label><br>
                               <input type="text" name="emailCliente" class="form-control" value="<?= $emailCliente; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-white">Senha:</label>
                                <input type="password" name="senhaCliente" class="form-control" value="<?= $senhaCliente; ?>">
                            </div>
                            <div class="form-group">
                                <label for="conf-senha" class="text-white" style="padding-right: ">Confirmar Senha</label>
                                <input type="password" name="confSenha" class="form-control" value="<?= $senhaCliente; ?>">
                            </div>
                            <div class="form-group">
                                <input id="botaoBusca" type="submit" name="cadastrar" class="btn" value="Cadastrar" style="">
                                <br><br>
                            </div>
                            <div id="register-link" class="text-right"> 
                                <span class="text-right text-white" style="font-size: 12px"> Todos os campos são obrigatórios</span><br>
                                <a href="<?= URL; ?>login/index" class="" style="color: #a80788">Já sou usuário</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     </div>
  	<div style="height: 120px"></div>

</main>