$(function(){
	var dados = $('.root').attr('id');
	var split = dados.split(':');
	
	// Login loja
	$('input[name=logar_loja]').on('click', function(e){
		e.preventDefault();
		var botao = $(this);
		var dados = $('form[name=loja]').serializeArray();
			dados.push({name: "token", value: split[1]});
		
		botao.prop('value', 'Aguarde...');
		botao.prop('disabled', true);
		
		len = dados.length,
		objeto = {};
		for (i = 0; i < len; i++) {
			objeto[dados[i].name] = dados[i].value;
		}
		
		er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2,3}$/;
		
		if (!objeto['email'].trim() || !objeto['senha'].trim()) {
			iziToast.error({
				message: 'Preencha todos os campos',
				position: 'topCenter',
				timeout: 1000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Entrar');
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
			botao.prop('value', 'Entrar');
			botao.prop('disabled', false);
		} else {
			$.ajax({
				method: 'POST',
				url: split[0] + '/admin',
				data: dados,
				dataType: 'json',
				cache: false,
				success: function(retorno){
					if (retorno.resposta == 'logou') {
						$('.root').attr('id', split[1] = retorno.token);
						limpar('login');
						botao.prop('value', 'Entrar');
						botao.prop('disabled', false);
						location.href = split[0] + '/admin/inicio';
					} else if (retorno.resposta == 'login_invalido') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.error({
							message: 'E-mail ou senha inválido',
							position: 'topCenter',
							timeout: 2000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown'
						});
						botao.prop('value', 'Entrar');
						botao.prop('disabled', false);
					} else if (retorno.resposta == 'expirou') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.error({
							message: 'Acesso expirado',
							position: 'topCenter',
							timeout: 2000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown'
						});
						botao.prop('value', 'Entrar');
						botao.prop('disabled', false);
					}
				}, 
				error: function(e){
					iziToast.error({
						message: 'Erro ao logar, tente novamente',
						position: 'topCenter',
						timeout: 2000,
						transitionIn: 'bounceInDown',
						transitionOut: 'fadeOut',
						transitionInMobile: 'bounceInDown',
						transitionOutMobile: 'fadeOutDown'
					});
					botao.prop('value', 'Entrar');
					botao.prop('disabled', false);
				}
			});
		}
		return false;
	});
	
	// Esqueci senha
	$('input[name=enviar_email]').on('click', function(e){
		e.preventDefault();
		var botao = $(this);
		var dados = $('form[name=email]').serializeArray();
			dados.push({name: "token", value: split[1]});
		
		botao.prop('value', 'Aguarde...');
		botao.prop('disabled', true);
		
		len = dados.length,
		objeto = {};
		for (i = 0; i < len; i++) {
			objeto[dados[i].name] = dados[i].value;
		}
		
		er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2,3}$/;
		
		if (!objeto['email'].trim()) {
			iziToast.error({
				message: 'Informe o seu e-mail',
				position: 'topCenter',
				timeout: 1000,
				transitionIn: 'bounceInDown',
				transitionOut: 'fadeOut',
				transitionInMobile: 'bounceInDown',
				transitionOutMobile: 'fadeOutDown'
			});
			botao.prop('value', 'Enviar');
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
			botao.prop('value', 'Enviar');
			botao.prop('disabled', false);
		} else {
			$.ajax({
				method: 'POST',
				url: split[0] + '/admin/esqueci/senha',
				data: dados,
				dataType: 'json',
				cache: false,
				success: function(retorno){
					if (retorno.resposta == 'enviou') {
						$('.root').attr('id', split[1] = retorno.token);
						limpar('email');
						botao.prop('value', 'Enviar');
						botao.prop('disabled', false);
						
						$.confirm({
							theme: 'white',
							title: 'Enviamos um email contendo o link para redefinir sua senha',
							content: '',
							icon: '',
							confirmButton: 'Ok',
							confirmButtonClass: 'btn-primary',
							animation: 'scale',
							animationClose: 'top',
							opacity: 0.5
						});
					} else if (retorno.resposta == 'nao_encontrado') {
						$('.root').attr('id', split[1] = retorno.token);
						iziToast.error({
							message: 'E-mail ou senha inválido',
							position: 'topCenter',
							timeout: 2000,
							transitionIn: 'bounceInDown',
							transitionOut: 'fadeOut',
							transitionInMobile: 'bounceInDown',
							transitionOutMobile: 'fadeOutDown'
						});
						botao.prop('value', 'Enviar');
						botao.prop('disabled', false);
					}
				}, 
				error: function(e){
					//$('.root').attr('id', split[1] = retorno.token);
					iziToast.error({
						message: 'Erro ao enviar, tente novamente',
						position: 'topCenter',
						timeout: 2000,
						transitionIn: 'bounceInDown',
						transitionOut: 'fadeOut',
						transitionInMobile: 'bounceInDown',
						transitionOutMobile: 'fadeOutDown'
					});
					botao.prop('value', 'Enviar');
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
});