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
        <div>Bem vindo!</div>
    </div>
    <div class="table-responsive"> 
        <?php
            if ($this->dados['botao']['cad_usuario']){?>
                <a href="<?php echo URL . 'adm-func/addFunc'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-success btn-sm">
                            Cadastrar Funcionário
                        </button>
                    </div>
                </a>
        <?php
            }
        if (empty($this->dados['listFunc'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum funcionário encontrado!
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
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Descrição</th>
                    <th>Serviço</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($this->dados['listFunc'] as $funcionarios) {
                    extract($funcionarios);
                    ?>
                    <tr>
                        <th><?php echo $idFunc; ?></th>
                        <td class="text-center">
                            <img src="<?=URL.'assets/img/funcionarios/'.$fotoFunc?>" style="width: 50px; height: 50px; border-radius: 40px">       
                        </td>
                        <td class="d-none d-sm-table-cell"><?php echo $nomeFunc; ?></td>
                        <td class="d-none d-sm-table-cell"><?php echo $cpfFunc; ?></td>
                        <td class="d-none d-sm-table-cell"><?php echo $descFunc; ?></td>
                        <td class="d-none d-sm-table-cell"><?php echo $descServico; ?></td>
                        <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->dados['botao']['edit_usuario']) {
                                        echo "<a href='". URL . "adm-func/upFunc/$idFunc' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->dados['botao']['del_usuario']) {
                                        echo "<a href='". URL . "adm-func/delFunc/$idFunc' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    if ($this->dados['botao']['mostrar_horarios']) {
                                        echo "<a href='". URL . "adm-func/horariosFunc/$idFunc' class='btn btn-outline-info btn-sm'>Horarios</a> ";
                                    }
                                    ?>
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