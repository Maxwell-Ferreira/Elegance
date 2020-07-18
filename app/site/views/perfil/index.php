<?php

if (!defined('URL')){
    header("location: /");
    exit();
}
if(empty($_SESSION)){
    header("location: ".URL);
}

if(isset($_GET["swall"])){
    echo '<div id="swall"></div>';
}
?>
<main role="main">
    <?php 
            if (isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?> 
    <div id="perfil" class="text-white">
        <div id="dadosUsuario">
            <div id="titulo" class="col-md-12">
                <h1>Dados do Usuário</h1>
            </div>

            <div id="item" class="col-md-8"> 
                <h4>Nome</h4>
                <div id="caixaDeTexto" class="form-control">
                    <h5> <?=$_SESSION['nomeCliente']?></h5>
                </div>
            </div>

            <div id="item" class="col-md-8"> 
                <h4>Email</h4>
                <div id="caixaDeTexto" class="form-control">
                    <h5> <?=$_SESSION['emailCliente']?></h5>
                </div>
            </div> 

            <div id="item" class="col-md-8"> 
                <h4>Senha</h4>
                <div id="caixaDeTexto" class="form-control">
                    <h5> 
                        <?php 
                            echo $_SESSION['senhaCliente'][0];
                            for($j = 1; $j < strlen($_SESSION['senhaCliente']); $j++) {
                                echo "*";
                            }
                        ?>
                    </h5>
                </div>
            </div>
            <div id="item" class="col-md-8" style="display: flex">
                <div id="botaoBusca" class="btn">
                    <a href="<?= URL; ?>perfil/alterarDados" class="text-white">Alterar dados</a>  
                </div>
            </div>
        </div>
        <div id="separador">
            <div class="col-md-8"></div>
        </div>

        <div id="servicosUser" class="text-white">
            <div id="titulo" class="col-md-12">
                <h1>Últimos serviços do Usuário</h1> 
            </div>

            <div id="separador" style="margin-top: 40px">
                <div class="col-md-5"></div> 
            </div>

            <?php 
            //var_dump($this->dados['atendimentosPerfil']); exit();
                foreach($this->dados['atendimentosPerfil'] as $atendimentos){ 
            ?>
            <div id="servico" class="col-md-6">
                <img src="<?=URL.'assets/img/servicos/'.$atendimentos['imagemServico']?>" width="170px" height="170px">
                <div id="tituloServico">
                    <h5>Serviço: <?=$atendimentos['descServico']?> </h5>
                    <p>Data marcado: <?=$atendimentos['data']?> </p>
                    <p>Horário: <?=$atendimentos['horario']?> </p>
                    <p>Funcionário: <?=$atendimentos['nomeFunc']?> </p>
                    <form method="post" name="cancelar">
                        <p><button id="botaoCancelar" type="button" data-toggle="modal" data-target=".bd-example-modal-sm<?=$atendimentos['idAtendimento']?>">Cancelar atendimento</button></p>
                        <div class="modal fade bd-example-modal-sm<?=$atendimentos['idAtendimento']?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content" style="color: black">
                                  <h4 style="text-align: center; color: #82116b; padding-top: 50px; padding-bottom: 50px">Tem certeza que deseja cancelar este atendimento?</h4> 
                                    <div class="modal-footer">
                                        <input type="button" id="botaoBusca2" class="btn" value="Fechar" data-dismiss="modal">
                                        <button type="submit" name="btnCancelar" id="botaoBusca" class="btn" value="<?= $atendimentos['idAtendimento'] ?>">Cancelar</button> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="separador"> 
                <div class="col-md-5"></div> 
            </div>
            <?php 
                }
            ?>
        </div>
    </div>



    <div style="height: 80px"></div> 
</main>