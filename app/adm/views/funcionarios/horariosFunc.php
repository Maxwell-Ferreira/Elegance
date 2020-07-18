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
    <div class="table-responsive">
        <div class="content p-1">
            <div class="list-group-item">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <h2 class="display-4 titulo">Horários do Funcionário</h2>
                    </div>
                </div><hr>
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <?php 
                            foreach($this->dados['listHorario'] as $horarios){
                            ?>
                            <td class="text-center"><span><?= $horarios['horario'] ?></span></td>
                            <?php
                            } ?>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div>
                    <a href="<?= URL?>adm-func/addHorarioFunc/<?= $this->dados['idFunc']?>" class="btn btn-primary">Cadastrar horário</a>
                </div>
            </div>
        </div>
    </div>
</main>