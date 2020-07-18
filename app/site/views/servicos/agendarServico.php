<?php

if (!defined('URL')){
    header("location: /"); 
    exit();
}

if(empty($_SESSION['idCliente'])){
	header("location: ".URL."login/index");
}

$dadosServico = $this->dados['servico'][0];
extract($dadosServico);

?>

<main role="main"> 

<div id="principal-servico" class="text-white">
	<form method="post" name="agendarServico">
		<div class="form-group">
			<h2  class="col-md-9">Agendar serviço:<br><?= $descServico ?></h2>
			<div id="bordaBaixo" class="col-md-8"></div>
		</div>
	  	<div class="form-group"> 
	    	<label for="idFuncionarios">Funcionario</label>
	    	<select class="form-control col-md-8" id="idFuncionarios" name="funcionario">
	    		<option value="">Selecione um funcionario</option>
	    		<?php 
	    			foreach($this->dados['funcionarios'] as $funcionarios){
	    				echo "<option value='".$funcionarios['idFunc']."'>". $funcionarios['nomeFunc'] ."</option>";
	    			} 
	    		?> 
	    	</select>
	  	</div>
	  	<div class="form-group">
	    	<label for="idDatas">Data</label>
	    	<select class="form-control col-md-8" id="idDatas" name="datas">
	    		<option value="">Selecione a data</option>
	    	</select>
	  	</div>
	  	<div class="form-group">
	    	<label for="idHorarios">Horario</label> 
	    	<select class="form-control col-md-8" id="idHorarios" name="horarios">
	    		<option value="">Selecione o Horario</option>
	    	</select>
	  	</div>
	  	<a href="<?=URL.'servicos/index'?>" id="botaoBusca2" class="btn">Cancelar</a>
        <button type="button" id="botaoBusca" class="btn" data-toggle="modal" data-target=".bd-example-modal-sm">Agendar</button>
            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content" style="color: black">
                  <h4 style="text-align: center; color: #82116b; padding-top: 50px; padding-bottom: 50px">Tem certeza que deseja realizar este agendamento?</h4> 
                    <div class="modal-footer">
                        <input type="button" id="botaoBusca2" class="btn" value="Cancelar" data-dismiss="modal">
                        <input type="submit" name="btnAgendar" id="botaoBusca" class="btn" value="Agendar">
                    </div>
                </div>
              </div>
            </div>
	</form> 
</div>

</main>