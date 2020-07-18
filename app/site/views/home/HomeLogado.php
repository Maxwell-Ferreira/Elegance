<?php

if (!defined('URL')){
    header("location: /");
    exit();
}

if(!isset($_SESSION['idCliente'])){
  header("location: ".URL.'home/index');
}
?>
<main role="main">

  <div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      </ol>
    <div class="carousel-inner">
      <?php
        $cont = 0;
        foreach ($this->dados['carousel'] as $carousel) {
          extract($carousel); ?>
      <div class="carousel-item <?php if ($cont == 0){ echo "active"; }?>">
        <img src="<?= URL .'assets/img/carousel/'.$id .'/'.$imagem; ?>" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5><?php echo $titulo;?></h5>
        </div>
      </div>
      <?php
        $cont++;
        }
      ?>      
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div> 

<hr class="" style="margin-top: 40px; border-top: solid 1px #fff; width: 70%">

<div style="text-align: center;">
    <div  style="display: inline;">
      <?php
        $logo = "";
        foreach ($this->dados['logos'] as $logos) {
        extract($logos);

        if($id == 1){
          $logo = $imagem;
        }
      }
      ?>
        <img src="<?= URL. 'assets/img/logo/'.$logo; ?>" style="width: 40%; min-width: 260px; margin-top: 10px">
    </div>
</div>

<div style="text-align: center; margin-top: 30px; margin-left: 25%; margin-right: 25%">
    <div  style="display: inline;">
        <p class="text-white">VOCE ESTÁ LOGADO</p>
    </div>
</div>

<div style="text-align: center; margin-top: 30px">
    <div  style="display: inline;">
      <?php
        foreach ($this->dados['imagensHome'] as $imagensHome) {
        extract($imagensHome);
      ?>
        <img class="imgLocal" src="<?= URL .'assets/img/fotos/'.$id .'/'.$imagem; ?>">
      <?php } ?>

    </div>
</div>

<hr class="" style="margin-top: 40px; border-top: solid 1px #fff; width: 90%">

<div style="margin-top: 30px;  margin-left: 8%; margin-right: 8%;">
    <h1 class="text-white"  style="margin-left: 6%">Perguntas Frequentes</h1>
    <hr class="" style="border-top: 3px solid #fff; width: 394px; margin-left: 6%; margin-top: -3px">
</div>

<div style="margin-top: 30px;  margin-left: 13%; margin-right: 17%; border: 1px solid #fff; border-radius: 5px; background: linear-gradient(to right, #540444, #87056d, #540444); box-shadow: 5px 5px 5px black;">
    <ul style="margin-left: 6%; list-style: none; margin-top: 30px; margin-right: 60px">
      <?php
        foreach ($this->dados['perguntas_frequentes'] as $perguntasFrequentes) {
        extract($perguntasFrequentes);
      ?>
      <li style=""><h3 class="text-white"><?php echo $pergunta;?></h3></li>
      <p class="text-white"><?php echo $resposta;?></p>
      <br>
      <?php } ?>
    </ul>
</div>

<div style="height: 80px"></div>

</main>