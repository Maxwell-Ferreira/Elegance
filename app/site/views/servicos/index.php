<?php

if (!defined('URL')){
    header("location: /"); 
    exit();
}
?> 

<?php
    $logo = "";
    foreach ($this->dados['logos'] as $logos) {  
      if($logos['id'] == 1){
        $logo = $logos['imagem'];
      } 
    } 
?>
<main role="main">
<section class="our-webcoderskull padding-lg" style="margin-top: 30px">
  <?php
    if (isset($_SESSION['msg'])){
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
    }
  ?> 
  <div class="container">
    <div class="row heading heading-icon">
        <h2><label style="text-shadow: 5px 0px 5px black;">Serviços com horários disponíveis</label></h2>
        <p style="margin-top: -60px; margin-bottom: 60px; text-align: center; color: white">Caso deseje marcar seu atendimento apenas em horários disponíveis selecione a opção "Agendar". Se o horário que você que você deseja marcar já estiver ocupado, selecione a opção "Agendar ou solicitar troca" para solicitar uma troca de horário a outro usuário.</p>
    </div>
    <ul class="row m-2 text-center">
      <?php  
        foreach ($this->dados['servico'] as $servico) {
      ?>
      <li class="col-md-8 col-lg-4">
          <div class="cnt-block equal-hight" style=" border-radius: 8px; box-shadow: 5px 5px 5px black;">
            <figure><img src="<?= URL. 'assets/img/servicos/'.$servico['imagemServico']; ?>" class="img-responsive" alt=""></figure>
            <h5 style="white-space: nowrap;"><?php echo $servico['descServico']; ?></h5>
            <p>Valor: R$<?php echo $servico['valorServico']; ?></p>
              <a id="botaoBusca" class="btn" <?php 
                if(empty($_SESSION['idCliente'])){
                  echo "data-target='.bd-example-modal-sm' data-toggle='modal'";
                }else{
                  echo "href='".URL."servicos/agendarServico/".$servico['idServico']."'";
                }?>> Agendar</a>
              <br><br>
              <a id="botaoBusca3" class="btn" <?php 
                if(empty($_SESSION['idCliente'])){
                  echo "data-target='.bd-example-modal-sm' data-toggle='modal'";
                }else{
                  echo "href='".URL."servicos/agendarTrocarServico/".$servico['idServico']."'";
                }?>> Solicitar Troca</a>  

          </div>
      </li>
      <?php } ?>
    </ul> 
  </div>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" style="color: black">
      <h4 style="text-align: center; color: #82116b; padding-top: 50px; padding-bottom: 50px">Você precisa estar logado para agendar um atendimento!</h4> 
      <div class="modal-footer">
        <input type="button" id="botaoBusca2" class="btn" value="Fechar" data-dismiss="modal">
        <a href="<?=URL?>login/index" name="alterar" id="botaoBusca" class="btn">Fazer login</a>
      </div>
    </div>
  </div>
</div>
</section>
  <div style="height: 120px"></div>
</main>