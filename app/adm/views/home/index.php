<?php

if (!defined('URL')){
    header("location: /");
    exit();
}?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
        <div>Bem vindo! <span style="color:red"><?= $_SESSION['nomeAdm']; ?></span></div>
    </div>
    <div class="table-responsive">
        <h1 class="h3">Gerenciar Agendamentos</h1>
        <?php
        if (empty($this->dados['listaAgendamentos'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                Nenhum agendamento encontrado!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        }
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Serviço</th>
                    <th>Funcionário</th>
                    <th>Data</th>
                    <th>Horario</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($this->dados['listaAgendamentos'] as $agendamento) {
                    extract($agendamento);
                    ?>
                    <tr>
                        <th><?php echo $idAtendimento; ?></th>

                        <td class="d-none d-sm-table-cell"><?php echo $nomeCliente; ?></td>
                        <td class="d-none d-sm-table-cell"><?php echo $descServico; ?></td>
                        <td class="d-none d-sm-table-cell"><?php echo $nomeFunc; ?></td>
                        <td class="d-none d-sm-table-cell"><?php echo $data; ?></td>
                        <td class="d-none d-sm-table-cell"><?php echo $horario; ?></td>
                        <td class="text-center">
                                <span class="d-none d-md-block">
                                  <a href='". URL . "adm-func/horariosFunc/$idFunc' class='btn btn-outline-info btn-sm'>Realizado</a>
                                </span>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
    </div> 
</main>


