<?php

if (!defined('URL')){
    header("location: /");
    exit();
}

/*if(empty($_SESSION)){
    header("location: ".URL);
}*/
?>
<main role="main">
    <div id="perfil" class="text-white">
        <?php
            if (isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?> 
        <div id="titulo" class="col-md-12">
            <h1>Alterar dados do Usuário</h1> 
        </div> 
        <form method="post" class="form"> 
            <div id="item" class="col-md-8"> 
                <label for="idNome"><h4>Nome</h4></label><br> 
                <input id="idNome" type="text" name="nomeCliente" class="form-control" value="<?= $_SESSION['nomeCliente']?>">
            </div>

            <div id="item" class="col-md-8"> 
                <label for="idEmail"><h4>Email</h4></label><br> 
                <input id="idEmail" type="text" name="emailCliente" class="form-control" value="<?= $_SESSION['emailCliente']?>">
            </div>

            <div id="item" class="col-md-8"> 
                <label for="idSenha"><h4>Senha</h4></label><br> 
                <input id="idSenha" type="password" name="senhaCliente" class="form-control" value="<?= $_SESSION['senhaCliente']?>">
            </div>

            <div id="item" class="col-md-8"> 
                <label for="idConfSenha"><h4>Confirmar Senha</h4></label><br> 
                <input id="idConfSenha" type="password" name="confSenha" class="form-control" value="<?= $_SESSION['senhaCliente']?>">
            </div>

            <div id="item" class="col-md-8" style="text-align: right; height: 35px">
                <label for="idMostrarSenha"><p>Mostrar Senha</p></label> 
                <input id="idMostrarSenha" type="checkbox" onclick="mostrarSenha()" style="height: 15px;"> 
            </div>

            <div id="" class="col-md-8" style="display: flex;">
                <a href="<?= URL; ?>perfil/index">
                    <div id="botaoBusca2" class="btn">Cancelar</div>
                </a>
                <div class="botao2">
                    <button type="button" id="botaoBusca" class="btn" data-toggle="modal" data-target=".bd-example-modal-sm">Alterar Dados</button>
                </div>
                <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content" style="color: black">
                      <h4 style="text-align: center; color: #82116b; padding-top: 50px; padding-bottom: 50px">Tem certeza que deseja alterar seus dados?</h4> 
                        <div class="modal-footer">
                            <input type="button" id="botaoBusca2" class="btn" value="fechar" data-dismiss="modal">
                            <input type="submit" name="alterar" id="botaoBusca" class="btn" value="Alterar">
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </form> 
    </div>


    <div id="separador" class="col-sm-8" style="margin-left: 100px">
        <div class="col-md-10"></div>
    </div>

    <div style="height: 80px"></div>
</main>