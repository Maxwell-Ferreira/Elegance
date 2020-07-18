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
                        <h2 class="display-4 titulo">Cadastrar Serviço</h2>
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
                            <label><span class="text-danger">*</span> Descrição</label>
                            <input name="descServico" type="text" class="form-control" placeholder="Digite a descrição do serviço" value="<?php
                            if (isset($valorForm['descServico'])) {
                                echo $valorForm['descServico'];
                            }
                            ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label><span class="text-danger">*</span> Valor</label>
                            <input name="valorServico" type="numeric" class="form-control" placeholder="Informe o valor do serviço" value="<?php
                            if (isset($valorForm['valorServico'])) {
                                echo $valorForm['valorServico'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label><span class="text-danger">*</span> Imagem Servico</label>
                            <input name="imagemServico" type="file" onchange="previewImagem();">
                        </div>
                        </div>
                    </div>
                    <p>
                        <span class="text-danger">* </span>Campo obrigatório
                    </p>
                    <input name="CadServico" type="submit" class="btn btn-warning" value="Salvar">
                </form>
            </div>
        </div>
    </div>
</main>