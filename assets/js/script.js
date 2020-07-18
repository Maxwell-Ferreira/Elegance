$(function(){

	if ($("#swall").length){ 
        Swal.fire({
		  icon: 'success',
		  title: 'Agendamento Realizado!',
		  html: '<p>Fique atento caso queira cancelar pois há um período limite de até 2 horas antes do horario marcado!<p>'
		  		+ '<p>Você também pode receber propostas para ceder seu horário à outras pessoas. Caso esteja de acordo, você pode aceitar a situação, se não, poderá nega-la.</p>'
		});
    }

	function listarDatas(idFunc){
		$.ajax({
			type: 'GET', 
			url: 'http://127.0.0.1/elegance/funcoes.php',
			data: {
				acao: 'listarDatas',
				id: idFunc
			},
			dataType: 'json',
			beforeSend: function(data){
				$('select[name=datas]').html('<option>Carregando...</option>');
			},
			success: function(data){
				console.log(data);
				$('select[name=datas]').html('');
				$('select[name=datas]').append('<option>Selecione a data</option>');
				for(i = 0; i < data.qtd; i++){
					$('select[name=datas]').append('<option value="'+data.datas[i]+'">'+data.dataFormat[i]+'</option>');
				}
			}
		});
	}
  
	function listarHorarios(valData, func){
		$.ajax({
			type: 'GET',
			url: 'http://127.0.0.1/elegance/funcoes.php',
			data: {
				acao: 'listarHorarios',
				valData: valData,
				func: func
			},
			dataType: 'json',
			beforeSend: function(){
				$('select[name=horarios]').html('<option>Carregando...</option>');
			},
			success: function(data){
				console.log(data);
				$('select[name=horarios]').html('');
				$('select[name=horarios]').append('<option>Selecione o horario</option>');
				for(i = 0; i < data.qtd; i++){
					$('select[name=horarios]').append('<option value="'+data.idHorario[i]+'">'+data.horario[i]+'</option>');
				}
			}
		});
	}

	$('select[name=funcionario]').change(function(){
		$('select[name=horarios]').val($("select[name=horarios] option:first-child").val());
		var idData = $(this).val();
		listarDatas(idData);
	});

	$('select[name=datas]').change(function(){
		var data = $(this).val();
		var func = $('select[name=funcionario]').val();
		listarHorarios(data, func);
	});
});

$(function(){

	function listarDatas2(idFunc, idCliente){
		$.ajax({
			type: 'GET', 
			url: 'http://127.0.0.1/elegance/funcoes.php',
			data: {
				acao: 'listarDatas2',
				idFunc: idFunc,
				idCliente: idCliente
			},
			dataType: 'json',
			beforeSend: function(data){
				$('select[name=datas2]').html('<option>Carregando...</option>');
			},
			success: function(data){
				console.log(data);
				$('select[name=datas2]').html('');
				$('select[name=datas2]').append('<option>Selecione a data</option>');
				for(i = 0; i < data.qtd; i++){
					$('select[name=datas2]').append('<option value="'+data.datas[i]+'">'+data.dataFormat[i]+'</option>');
				}
			}
		});
	}
  
	function listarHorarios2(valData, func){
		$.ajax({
			type: 'GET',
			url: 'http://127.0.0.1/elegance/funcoes.php',
			data: {
				acao: 'listarHorarios2',
				valData: valData,
				func: func
			},
			dataType: 'json',
			beforeSend: function(){
				$('select[name=horarios2]').html('<option>Carregando...</option>');
			},
			success: function(data){
				//console.log(data);
				$('select[name=horarios2]').html('');
				$('select[name=horarios2]').append('<option>Selecione o horario</option>');
				for(i = 0; i < data.qtd; i++){
					$('select[name=horarios2]').append('<option value="'+data.idHorario[i]+'">'+data.horario[i]+'</option>');
				}
			}
		});
	}

	$('select[name=funcionario2]').change(function(){
		$('select[name=horarios2]').val($("select[name=horarios2] option:first-child").val());
		var idCliente = $('input[name=idCliente2]').val();
		var idFunc = $(this).val();
		listarDatas2(idFunc, idCliente);
	});

	$('select[name=datas2]').change(function(){
		var data = $(this).val();
		var func = $('select[name=funcionario2]').val();
		listarHorarios2(data, func);
	});
});