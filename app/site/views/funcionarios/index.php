<?php

if (!defined('URL')){
    header("location: /");
    exit();
}
?>

<?php
    $logo = "";
    foreach ($this->dados['logos'] as $logos) {
      extract($logos);

      if($id == 1){
        $logo = $imagem;
      }
    }
?>
<main role="main">

<section id="team" class="pb-5">
    <div class="container">
        <h5 class="section-title h1 text-white">NOSSOS FUNCIONÁRIOS</h5>
        <div class="row">
            <!-- Team member -->
            <?php 
                foreach($this->dados['funcionario'] as $funcionarios){
            ?>
            <div class="col-md-4 col-sm-8">
                <div class="frontside">
                    <div class="card">
                        <div class="card-body text-center">
                            <p><img class=" img-fluid" src="<?=URL.'assets/img/funcionarios/'.$funcionarios['fotoFunc'] ?>" alt="card image"></p>
                            <h4 class="card-title"><?= $funcionarios['nomeFunc'] ?></h4>
                            <p class="card-text"><?= $funcionarios['descFunc'] ?></p>
                            <p class="card-text"><strong>Serviço: </strong>
                                <?php foreach($this->dados['servico'] as $servicos){
                                    if($servicos['idServico'] == $funcionarios['servicoFunc']){
                                        echo $servicos['descServico'];
                                        ?>
                            </p>
                            <a href="<?=URL.'servicos/agendarServico/'.$servicos['idServico']?>" id="botaoBusca" class="btn">Agendar</a>
                                <?php
                                    }
                                }
                                ?>                  
                        </div>
                    </div> 
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>

</main>