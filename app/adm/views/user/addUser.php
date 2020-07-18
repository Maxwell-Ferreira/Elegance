<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
        <div>Bem vindo!</div>
    </div>
    <div class="table-responsive"><?php
if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}
if (isset($this->dados['form'][0])) {
    $valorForm = $this->dados['form'][0];
}
//var_dump($this->dados['select']);
?>
        <div class="content p-1">
            <div class="list-group-item">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <h2 class="display-4 titulo">Cadastrar Usuário</h2>
                    </div>
                </div><hr>
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <form method="POST" action="" enctype="multipart/form-data">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><span class="text-danger">*</span> Nome</label>
                            <input name="nomeCliente" type="text" class="form-control" placeholder="Digite o nome completo" value="<?php
                            if (isset($valorForm['nome'])) {
                                echo $valorForm['nome'];
                            }
                            ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><span class="text-danger">*</span> E-mail</label>
                            <input name="emailCliente" type="text" class="form-control" placeholder="Seu melhor e-mail" value="<?php
                            if (isset($valorForm['email'])) {
                                echo $valorForm['email'];
                            }
                            ?>">
                        </div>
                    </div>
                    <div  class="form-row">
                        <div class="form-group col-md-3">
                            <label><span class="text-danger">*</span> Senha</label>
                            <input name="senhaCliente" type="password" class="form-control" id="nome" placeholder="" value="<?php
                            if (isset($valorForm['senha'])) {
                                echo $valorForm['senha'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label><span class="text-danger">*</span> Confirmar Senha</label>
                            <input name="conf-senha" type="password" class="form-control" id="nome" placeholder="" value="<?php
                            if (isset($valorForm['senha'])) {
                                echo $valorForm['senha'];
                            }
                            ?>">
                        </div>
                    </div>
                    <p>
                        <span class="text-danger">* </span>Campo obrigatório
                    </p>
                    <input name="CadUsuario" type="submit" class="btn btn-warning" value="Salvar">
                </form>
            </div>
        </div>
    </div>
</main>