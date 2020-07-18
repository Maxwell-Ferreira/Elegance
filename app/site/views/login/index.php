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
            $emailCliente = $senhaCliente = "";
        }else {
            extract($this->dados['formRetorno']);
        }
    ?> 

	<div id="login"> 
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6"> 
                    <div id="login-box" class="col-md-12" style="box-shadow: 0px 0px 15px black;">
                        <form id="login-form" class="form" action="" method="post">
                            <div class="form-group">
                                <label for="username" class="text-white">Email:</label><br>
                                <input type="text" name="emailCliente" class="form-control" value="<?= $emailCliente ?>">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-white">Senha:</label><br>
                                <input id="idSenha" type="password" name="senhaCliente" class="form-control" value="<?= $senhaCliente ?>">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-white"><span>Lembrar</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label>
                                <label for="mostrar-senha" class="text-white" style="padding-left: 10px"><span>Mostrar Senha</span> <span><input id="mostrar-senha" name="mostrar-senha" type="checkbox" onclick="mostrarSenha()"></span></label><br>
                                
                            </div>
                            <input id="botaoBusca" type="submit" name="login" class="btn" value="login">
                            <div id="register-link" class="text-right">
                                <a href="<?= URL; ?>cadastro/index" class="text-nd text-white">Cadastro</a> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  	<div style="height: 120px"></div>   


</main>