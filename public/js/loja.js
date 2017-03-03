$(function(){
	var dados = $('.root').attr('id');
	var split = dados.split(':');
	
	$('input[name=preco], input[name=estoque]').keypress(function(e){
		var tecla = (window.event) ? event.keyCode : e.which;   
		
		if ((tecla > 47 && tecla < 58)) {
			return true;
		} else if (tecla == 8 || tecla == 0) {
			return true;
		} else {
			return false;
		}
	});
	
	// Cadastrar produto
	$('input[name=cadastrar_produto]').on('click', function(e){
		e.preventDefault();
		var botao = $(this);
		var dados = $('form[name=produto]').serializeArray();
			dados.push({name: "token", value: split[1]});
			//dados.push({name: "loja", value: split[2]});
		
		botao.prop('value', 'Aguarde...');
		botao.prop('disabled', true);
		
		len = dados.length,
		objeto = {};
		for (i = 0; i < len; i++) {
			objeto[dados[i].name] = dados[i].value;
		}
		
		if (!objeto['nome'].trim() || !objeto['categoria'].trim() || !objeto['subcategoria'].trim() || !objeto['preco'].trim() || !objeto['estoque'].trim()) {
			iziToast.error({
				message: 'Preencha todos os campos',
				position: 'topCenter',
				timeout: 1000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Próximo passo');
			botao.prop('disabled', false);
		} else {
			$.ajax({
				method: 'POST',
				url: split[0] + '/admin/cadastrar/produto',
				data: dados,
				dataType: 'json',
				cache: false,
				success: function(retorno){
					if (retorno.resposta == 'cadastrou') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.success({
							message: 'Cadastrado com sucesso, aguarde...',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown',
							onClose: function(){
								location.href = split[0] + '/admin/cadastrar/produto/fotos';
							}
						});
						limpar('produto');
						botao.prop('value', 'Próximo passo');
						botao.prop('disabled', true);
					} else if (retorno.resposta == 'produto') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.error({
							message: 'Produto já existente',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown'
						});
						botao.prop('value', 'Próximo passo');
						botao.prop('disabled', false);
					}
				}, 
				error: function(e){
					iziToast.error({
						message: 'Erro ao cadastrar, tente novamente',
						position: 'topCenter',
						timeout: 2000,
						transitionIn: 'bounceInDown',
						transitionOut: 'fadeOut',
						transitionInMobile: 'bounceInDown',
						transitionOutMobile: 'fadeOutDown'
					});
					botao.prop('value', 'Próximo passo');
					botao.prop('disabled', false);
				}
			});
		}
		return false;
	});
	
	// Cadastrar foto
	$('input[name=cadastrar_foto]').on('click', function(e){
		e.preventDefault();
		var dadosProduto = $('.produto').attr('id');
		var splitProduto = dadosProduto.split(':');
		var botao = $(this);
		var dados = new FormData($(this)[0]);
		var files = $("#foto").get(0).files;
		
		botao.prop('value', 'Aguarde...');
		botao.prop('disabled', true);
		
		if (files.length == 0) {
			iziToast.error({
				message: 'Selecione uma foto',
				position: 'topCenter',
				timeout: 1000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Cadastrar');
			botao.prop('disabled', false);
		} else {
			dados.append("foto", files[0]);
			dados.append("token", split[1]);
			dados.append("produto", splitProduto[0]);
			
			$.ajax({
				method: 'POST',
				url: split[0] + '/admin/cadastrar/foto',
				data: dados,
				dataType: 'json',
				cache: false,
				processData: false,
				contentType: false,
				success: function(retorno){
					if (retorno.resposta == 'cadastrou') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.success({
							message: 'Cadastrado com sucesso, aguarde...',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown',
							onClose: function(){
								location.reload();
							}
						});
						botao.prop('value', 'Cadastrar');
						botao.prop('disabled', false);
					}
				}, 
				error: function(e){
					iziToast.error({
						message: 'Erro ao cadastrar, tente novamente',
						position: 'topCenter',
						timeout: 2000,
						transitionIn: 'bounceInDown',
						transitionOut: 'fadeOut',
						transitionInMobile: 'bounceInDown',
						transitionOutMobile: 'fadeOutDown'
					});
					botao.prop('value', 'Cadastrar');
					botao.prop('disabled', false);
				}
			});
		}
		return false;
	});
	
	// Excluir foto
	$('.excluir_foto').confirm({
		theme: 'white',
		title: 'Deseja excluir?',
		content: '',
		icon: '',
		confirmButton: 'Sim',
		cancelButton: 'Não',
		confirmButtonClass: 'btn-primary',
		cancelButtonClass: 'btn-danger',
		animation: 'scale',
		animationClose: 'top',
		opacity: 0.5,
		confirm: function(){
			var dadosFoto = this.$target.attr('id');
			var splitFoto = dadosFoto.split(':');
			
			$.ajax({
				type: 'POST',
				url: split[0] + '/admin/excluir/foto',
				data: {id: splitFoto[0], foto: splitFoto[1], token: split[1]},
				dataType: 'json',
				cache: false,
				success:function(retorno){
					if (retorno.resposta == 'excluiu') {
						iziToast.success({
							message: 'Excluído com sucesso, aguarde...',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown',
							onClose: function(){
								location.reload();
							}
						});
					}
				}
			});
		}
	});
	
	// Finalizar cadastro de fotos
	$('input[name=finalizar]').on('click', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: split[0] + '/admin/finalizar',
			dataType: 'json',
			cache: false,
			success:function(retorno){
				if (retorno.resposta == 'finalizou') {
					location.href = split[0] + '/admin/listar/produtos';
				}
			}
		});
	});
	
	// Editar produto
	$('input[name=editar_produto]').on('click', function(e){
		e.preventDefault();
		var produto = $('.produto').attr('id');
		var botao = $(this);
		var dados = $('form[name=produto]').serializeArray();
			dados.push({name: "produto", value: produto});
			dados.push({name: "token", value: split[1]});
			//dados.push({name: "loja", value: split[2]});
		
		botao.prop('value', 'Aguarde...');
		botao.prop('disabled', true);
		
		len = dados.length,
		objeto = {};
		for (i = 0; i < len; i++) {
			objeto[dados[i].name] = dados[i].value;
		}        
		
		if (!objeto['nome'].trim() || !objeto['categoria'].trim() || !objeto['subcategoria'].trim() || !objeto['preco'].trim() || !objeto['estoque'].trim()) {
			iziToast.error({
				message: 'Preencha todos os campos',
				position: 'topCenter',
				timeout: 1000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Atualizar');
			botao.prop('disabled', false);
		} else {
			$.ajax({
				method: 'POST',
				url: split[0] + '/admin/editar/produto',
				data: dados,
				dataType: 'json',
				cache: false,
				success: function(retorno){
					if (retorno.resposta == 'atualizou') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.success({
							message: 'Atualizado com sucesso, aguarde...',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown',
							onClose: function(){
								location.href = split[0] + '/admin/listar/produtos';
							}
						});
						limpar('produto');
						botao.prop('value', 'Atualizar');
						botao.prop('disabled', true);
					} else if (retorno.resposta == 'produto') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.error({
							message: 'Produto já existente',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown'
						});
						botao.prop('value', 'Atualizar');
						botao.prop('disabled', false);
					}
				}, 
				error: function(e){
					iziToast.error({
						message: 'Erro ao atualizar, tente novamente',
						position: 'topCenter',
						timeout: 2000,
						transitionIn: 'bounceInDown',
						transitionOut: 'fadeOut',
						transitionInMobile: 'bounceInDown',
						transitionOutMobile: 'fadeOutDown'
					});
					botao.prop('value', 'Atualizar');
					botao.prop('disabled', false);
				}
			});
		}
		return false;
	});
	
	// Editar estoque
	$('input[name=editar_estoque]').on('click', function(e){
		e.preventDefault();
		var produto = $('.produto').attr('id');
		var botao = $(this);
		var dados = $('form[name=produto]').serializeArray();
			dados.push({name: "produto", value: produto});
			dados.push({name: "token", value: split[1]});
			//dados.push({name: "loja", value: split[2]});
		
		botao.prop('value', 'Aguarde...');
		botao.prop('disabled', true);
		
		len = dados.length,
		objeto = {};
		for (i = 0; i < len; i++) {
			objeto[dados[i].name] = dados[i].value;
		}        
		
		if (!objeto['estoque'].trim() || objeto['estoque'] == 0) {
			iziToast.error({
				message: 'Informe a quantidade em estoque',
				position: 'topCenter',
				timeout: 2000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Atualizar');
			botao.prop('disabled', false);
		} else {
			$.ajax({
				method: 'POST',
				url: split[0] + '/admin/estoque/produto',
				data: dados,
				dataType: 'json',
				cache: false,
				success: function(retorno){
					if (retorno.resposta == 'atualizou') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.success({
							message: 'Atualizado com sucesso, aguarde...',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown',
							onClose: function(){
								location.href = split[0] + '/admin/listar/produtos';
							}
						});
						limpar('estoque');
						botao.prop('value', 'Atualizar');
						botao.prop('disabled', false);
					}
				}, 
				error: function(e){
					iziToast.error({
						message: 'Erro ao atualizar, tente novamente',
						position: 'topCenter',
						timeout: 2000,
						transitionIn: 'bounceInDown',
						transitionOut: 'fadeOut',
						transitionInMobile: 'bounceInDown',
						transitionOutMobile: 'fadeOutDown'
					});
					botao.prop('value', 'Atualizar');
					botao.prop('disabled', false);
				}
			});
		}
		return false;
	});
	
	// Excluir produto
	$('a.excluir_produto').confirm({
		theme: 'white',
		title: 'Deseja excluir?',
		content: '',
		icon: '',
		confirmButton: 'Sim',
		cancelButton: 'Não',
		confirmButtonClass: 'btn-primary',
		cancelButtonClass: 'btn-danger',
		animation: 'scale',
		animationClose: 'top',
		opacity: 0.5,
		confirm: function(){
			var produto = this.$target.attr('id');
			
			$.ajax({
				type: 'POST',
				url: split[0] + '/admin/excluir/produto',
				data: {produto: produto, loja: split[2], token: split[1]},
				dataType: 'json',
				cache: false,
				success:function(retorno){
					if (retorno.resposta == 'excluiu') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.success({
							message: 'Excluído com sucesso, aguarde...',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown',
							onClose: function(){
								location.href = split[0] + '/admin/listar/produtos';
							}
						});
					} else {
						iziToast.error({
							message: 'Erro ao excluir, tente novamente',
							position: 'topCenter',
							timeout: 2000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown'
						});
					}
				}
			});
		}
	});
	
	// Editar loja
	$('input[name=editar_loja]').on('click', function(e){
		e.preventDefault();
		var botao = $(this);
		var dados = $('form[name=loja]').serializeArray();
			dados.push({name: "token", value: split[1]});
			//dados.push({name: "loja", value: split[2]});
		
		botao.prop('value', 'Aguarde...');
		botao.prop('disabled', true);
		
		len = dados.length,
		objeto = {};
		for (i = 0; i < len; i++) {
			objeto[dados[i].name] = dados[i].value;
		}        
		
		if (!objeto['nome'].trim() || !objeto['estado'].trim() || !objeto['cidade'].trim() || !objeto['bairro'].trim() || !objeto['rua'].trim() || !objeto['numero'].trim()) {
			iziToast.error({
				message: 'Preencha todos os campos',
				position: 'topCenter',
				timeout: 1000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Atualizar');
			botao.prop('disabled', false);
		} else {
			$.ajax({
				method: 'POST',
				url: split[0] + '/admin/editar/loja',
				data: dados,
				dataType: 'json',
				cache: false,
				success: function(retorno){
					if (retorno.resposta == 'atualizou') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.success({
							message: 'Atualizado com sucesso, aguarde...',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown',
							onClose: function(){
								location.href = split[0] + '/admin/dados';
							}
						});
						botao.prop('value', 'Atualizar');
						botao.prop('disabled', true);
					}
				}, 
				error: function(e){
					iziToast.error({
						message: 'Erro ao atualizar, tente novamente',
						position: 'topCenter',
						timeout: 2000,
						transitionIn: 'bounceInDown',
						transitionOut: 'fadeOut',
						transitionInMobile: 'bounceInDown',
						transitionOutMobile: 'fadeOutDown'
					});
					botao.prop('value', 'Atualizar');
					botao.prop('disabled', false);
				}
			});
		}
		return false;
	});
	
	// Editar lojista
	$('input[name=editar_lojista]').on('click', function(e){
		e.preventDefault();
		var botao = $(this);
		var dados = $('form[name=lojista]').serializeArray();
			dados.push({name: "token", value: split[1]});
			//dados.push({name: "loja", value: split[2]});
		
		botao.prop('value', 'Aguarde...');
		botao.prop('disabled', true);
		
		len = dados.length,
		objeto = {};
		for (i = 0; i < len; i++) {
			objeto[dados[i].name] = dados[i].value;
		}
		
		er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2,3}$/;
		
		if (!objeto['nome'].trim() || !objeto['sobrenome'].trim() || !objeto['email'].trim() || !objeto['telefone'].trim()) {
			iziToast.error({
				message: 'Apenas o CNPJ não é obrigatório',
				position: 'topCenter',
				timeout: 1000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Atualizar');
			botao.prop('disabled', false);
		} else if (!er.exec(objeto['email'])) {
			iziToast.error({
				message: 'E-mail inválido',
				position: 'topCenter',
				timeout: 1000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Atualizar');
			botao.prop('disabled', false);
		} else {
			$.ajax({
				method: 'POST',
				url: split[0] + '/admin/editar/lojista',
				data: dados,
				dataType: 'json',
				cache: false,
				success: function(retorno){
					if (retorno.resposta == 'atualizou') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.success({
							message: 'Atualizado com sucesso, aguarde...',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown',
							onClose: function(){
								location.href = split[0] + '/admin/dados';
							}
						});
						botao.prop('value', 'Atualizar');
						botao.prop('disabled', true);
					} else if (retorno.resposta == 'existe') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.error({
							message: 'CPF já existente',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown'
						});
						botao.prop('value', 'Atualizar');
						botao.prop('disabled', false);
					}
				}, 
				error: function(e){
					iziToast.error({
						message: 'Erro ao atualizar, tente novamente',
						position: 'topCenter',
						timeout: 2000,
						transitionIn: 'bounceInDown',
						transitionOut: 'fadeOut',
						transitionInMobile: 'bounceInDown',
						transitionOutMobile: 'fadeOutDown'
					});
					botao.prop('value', 'Atualizar');
					botao.prop('disabled', false);
				}
			});
		}
		return false;
	});
	
	// Editar senha
	$('input[name=editar_senha]').on('click', function(e){
		e.preventDefault();
		var botao = $(this);
		var dados = $('form[name=senha]').serializeArray();
			dados.push({name: "token", value: split[1]});
			//dados.push({name: "loja", value: split[2]});
		
		botao.prop('value', 'Aguarde...');
		botao.prop('disabled', true);
		
		len = dados.length,
		objeto = {};
		for (i = 0; i < len; i++) {
			objeto[dados[i].name] = dados[i].value;
		}        
		
		if (!objeto['senha'].trim() || !objeto['senhaconfirma'].trim()) {
			iziToast.error({
				message: 'Preencha todos os campos',
				position: 'topCenter',
				timeout: 1000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Atualizar');
			botao.prop('disabled', false);
		} else if (objeto['senha'] != objeto['senhaconfirma']) {
			iziToast.error({
				message: 'Informe a senha corretamente',
				position: 'topCenter',
				timeout: 1000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Atualizar');
			botao.prop('disabled', false);
		} else if (objeto['senha'].length < 8){
			iziToast.error({
				message: 'Senha muito curta',
				position: 'topCenter',
				timeout: 1000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Atualizar');
			botao.prop('disabled', false);
		} else {
			$.ajax({
				method: 'POST',
				url: split[0] + '/admin/editar/senha',
				data: dados,
				dataType: 'json',
				cache: false,
				success: function(retorno){
					if (retorno.resposta == 'atualizou') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.success({
							message: 'Atualizado com sucesso, aguarde...',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown',
							onClose: function(){
								location.href = split[0] + '/admin/dados';
							}
						});
						botao.prop('value', 'Atualizar');
						botao.prop('disabled', true);
					} else if (retorno.resposta == 'existe') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.error({
							message: 'CPF já existente',
							position: 'topCenter',
							timeout: 1000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown'
						});
						botao.prop('value', 'Atualizar');
						botao.prop('disabled', false);
					}
				}, 
				error: function(e){
					iziToast.error({
						message: 'Erro ao atualizar, tente novamente',
						position: 'topCenter',
						timeout: 2000,
						transitionIn: 'bounceInDown',
						transitionOut: 'fadeOut',
						transitionInMobile: 'bounceInDown',
						transitionOutMobile: 'fadeOutDown'
					});
					botao.prop('value', 'Atualizar');
					botao.prop('disabled', false);
				}
			});
		}
		return false;
	});
	
	// Limpar campos
	function limpar(campo){
		$('form[name='+ campo +'] input[type=text]').each(function(){
			$(this).val('');
		});
	}
	
	// Atualizar Status
	$('select[name=status]').on('change', function(){
		document.getElementById('id_status').disabled = false;	
	});
	$("#seleciona_status").change(function(){
		var statusPedido = $('#seleciona_status option:selected').val();
		$('input#id_status').attr('name', statusPedido);
	});
	$('#id_status').click(function(){
		var idPedido = $('#status').attr('name');
		
		$.confirm({
			theme: 'white',
			title: 'Status: ' + $('#seleciona_status option:selected').text(),
			content: '',
			icon: '',
			confirmButton: 'Confirmar',
			cancelButton: 'Cancelar',
			confirmButtonClass: 'btn-primary',
			cancelButtonClass: 'btn-danger',
			animation: 'scale',
			animationClose: 'top',
			opacity: 0.5,
			confirm: function(){
				$.ajax({
					type: 'POST',
					url: split[0] + '/admin/atualizar/status',
					data: {id: idPedido, loja: split[2], statusPedido: $('input#id_status').attr('name')},
					dataType: 'json',
					cache: false,
					success:function(retorno){
						if (retorno.resposta == 'atualizou') {
							iziToast.success({
								message: 'Atualizado com sucesso, aguarde...',
								position: 'topCenter',
								timeout: 1000,
								transitionIn: 'bounceInDown',
								transitionOut: 'fadeOut',
								transitionInMobile: 'bounceInDown',
								transitionOutMobile: 'fadeOutDown',
								onClose: function(){
									location.href = split[0] + '/admin/detalhes/pedido/' + idPedido;
								}
							});
						}
					}
				});
			}
		});
	});
	
	// Cancelar pedido
	$('#cancelar').click(function(){
		var idPedido = $('#status').attr('name');
		
		$.confirm({
			theme: 'white',
			title: 'Deseja cancelar?',
			content: '',
			icon: '',
			confirmButton: 'Sim',
			cancelButton: 'Não',
			confirmButtonClass: 'btn-primary',
			cancelButtonClass: 'btn-danger',
			animation: 'scale',
			animationClose: 'top',
			opacity: 0.5,
			confirm: function(){
				$.ajax({
					type: 'POST',
					url: split[0] + '/admin/cancelar/pedido',
					data: {id: idPedido, loja: split[2]},
					dataType: 'json',
					cache: false,
					success:function(retorno){
						if (retorno.resposta == 'cancelou') {
							iziToast.success({
								message: 'Cancelado com sucesso, aguarde...',
								position: 'topCenter',
								timeout: 1000,
								transitionIn: 'bounceInDown',
								transitionOut: 'fadeOut',
								transitionInMobile: 'bounceInDown',
								transitionOutMobile: 'fadeOutDown',
								onClose: function(){
									location.href = split[0] + '/admin/listar/pedidos';
								}
							});
						}
					}
				});
			}
		});
	});
	
	// Deslogar
	$('a#sair').confirm({
		theme: 'white',
		title: 'Deseja sair do sistema?',
		content: '',
		icon: '',
		confirmButton: 'Sim',
		cancelButton: 'Não',
		confirmButtonClass: 'btn-primary',
		cancelButtonClass: 'btn-danger',
		animation: 'scale',
		animationClose: 'top',
		opacity: 0.5
	});
});