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
?>
        <div class="content p-1">
            <div class="list-group-item">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <h2 class="display-4 titulo">Alterar Funcionário</h2>
                    </div>
                </div><hr>
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <form method="POST" action="" enctype="multipart/form-data">
                    <input name="idFunc" type="hidden" value="<?php
                    if (isset($valorForm['idFunc'])) {
                        echo $valorForm['idFunc'];
                    }
                    ?>">
                    <input name="imagemAntiga" type="hidden" value="<?php
                    if (isset($valorForm['fotoFunc'])) {
                        echo $valorForm['fotoFunc'];
                    }
                    ?>">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><span class="text-danger">*</span> Nome</label>
                            <input name="nomeFunc" type="text" class="form-control" placeholder="" value="<?php
                            if (isset($valorForm['nomeFunc'])) {
                                echo $valorForm['nomeFunc'];
                            }
                            ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label><span class="text-danger">*</span> CPF</label>
                            <input name="cpfFunc" type="text" class="form-control" placeholder="" value="<?php
                            if (isset($valorForm['cpfFunc'])) {
                                echo $valorForm['cpfFunc'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label><span class="text-danger">*</span> Serviço</label>
                            <select name="servicoFunc" class="form-control">
                                <option>Selecione um serviço</option>
                                <?php 
                                    foreach($this->dados['listServico'] as $servicos){
                                ?>
                                    <option value="<?= $servicos['idServico']?>" 
                                        <?php if($servicos['idServico'] == $valorForm['servicoFunc']){ echo "selected";} ?>>
                                        <?= $servicos['descServico'] ?>
                                    </option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><span class="text-danger">*</span> Descrição</label>
                            <input name="descFunc" type="text" class="form-control" placeholder=""
                            value="<?php
                            if(isset($valorForm['descFunc'])){
                                echo $valorForm['descFunc'];
                            }
                            ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label><span class="text-danger"></span> Foto</label>
                            <input name="fotoFunc" type="file" onchange="previewFoto();">
                        </div>
                        <div class="form-group col-md-4" style="text-align: center;">
                            <img src="<?php echo URL.'assets/img/funcionarios/'.$valorForm['fotoFunc']?>" alt="Imagem do Funcionaio" id="preview-user" class="img-thumbnail" style="width: 150px; height: 150px">
                        </div>
                    </div>
                    <p>
                        <span class="text-danger">* </span>Campo obrigatório
                    </p>
                    <input name="upFunc" type="submit" class="btn btn-warning" value="Salvar">
                </form>
            </div>
        </div>
    </div>
</main>