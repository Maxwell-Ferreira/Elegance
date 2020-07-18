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
                        <h2 class="display-4 titulo">Cadastrar Horário</h2>
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
                            <label><span class="text-danger">*</span> Dorário (inicio)</label>
                            <input name="horario" type="text" class="form-control" placeholder="inicio(h:m:s)" value="<?php
                            if (isset($valorForm['horario'])) {
                                echo $valorForm['horario'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label><span class="text-danger">*</span> Duração</label>
                            <?php
                            if(isset($valorForm['duracao'])){
                            ?>
                            <div class="form-control"><?= $valorForm['duracao']?></div>
                            <input name="duracao" type="hidden" class="form-control" value="<?= $valorForm['duracao']; ?>">
                            <?php
                            }else{
                            ?>
                            <input name="duracao" type="text" class="form-control" placeholder="duração(h:m:s)">
                            <?php
                            } 
                            ?>
                            
                        </div>
                    </div>
                    <p>
                        <span class="text-danger">* </span>Campo obrigatório
                    </p>
                    <input name="cadHorario" type="submit" class="btn btn-warning" value="Salvar">
                </form>
            </div>
        </div>
    </div>
</main>