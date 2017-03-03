$(function (){
	var dados = $('.root').attr('id');
	var split = dados.split(':');
	
	$("select[name=categoria]").change(function(){
		$("select[name=subcategoria]").html('<option value="" id="carregando">Carregando...</option>');
		$.post(split[0] + "/combo/categoria", {
				categoria: $(this).val()
		}, function(retorno){
			var x = $("select[name=categoria] option#first");
				x.remove();
			document.getElementById('habilitado').disabled = false;
			$.each(JSON.parse(retorno), function(i, val){
				var subcategoria = '<option value="'+val.id +'">'+val.subcategoria+'</option>';
				$("select[name=subcategoria]").append(subcategoria);
				$("select[name=subcategoria] option:first").attr("selected", "selected");
			});
			var y = document.getElementById("carregando");
				y.remove();
		});
	});

	$("select[name=estado]").change(function(){
		$("select[name=cidade]").html('<option value="" id="carregando">Carregando...</option>');
		$.post(split[0] + "/combo/estado", {
			estado: $(this).val()
		}, function(retorno){
			var x = $("select[name=estado] option#first");
				x.remove();
			document.getElementById('habilitado').disabled = false;
			$.each(JSON.parse(retorno), function(i, val){
				var cidade = '<option value="'+val.id+'">'+val.nome+'</option>';
				$("select[name=cidade]").append(cidade);
				$("select[name=cidade] option:first").attr("selected", "selected");
			});
			var y = document.getElementById("carregando");
				y.remove();
		});
	});	
});