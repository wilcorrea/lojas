			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">Dados pessoais</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form name="lojista" autocomplete="off">
									<div class="form-group">
										<div class="col-md-6" style="padding-left: 0px; margin-bottom: 15px;">
											<label>Nome</label>
											<input type="text" name="nome" value="<?php echo $nome;?>" class="form-control">
										</div>
										<div class="col-md-6" style="padding: 0px; margin-bottom: 15px;">
											<label>Sobrenome</label>
											<input type="text" name="sobrenome" value="<?php echo $sobrenome;?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6" style="padding-left: 0px; margin-bottom: 15px;">
											<label>CPF</label>
											<input type="text" value="<?php echo $cpf;?>" class="form-control" OnKeyPress="formatarCPF('###.###.###-##', this);" maxlength="14" disabled>
										</div>
										<div class="col-md-6" style="padding: 0px; margin-bottom: 15px;">
											<label>CNPJ</label>
											<input type="text" name="cnpj" value="<?php echo $cnpj;?>" class="form-control" onPaste="return false" onkeyup="formatarCNPJ(this, event);" onblur="if(!validarCNPJ(this.value)){this.value='';}" maxlength="18">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6" style="padding-left: 0px; margin-bottom: 15px;">
											<label>E-mail</label>
											<input type="text" name="email" value="<?php echo $email;?>" maxlength="50" class="form-control">
										</div>
										<div class="col-md-6" style="padding: 0; margin-bottom: 15px;">
											<label>Telefone</label>
											<input type="text" name="telefone" id="celular" value="<?php echo $telefone;?>" class="form-control" maxlength="14">
										</div>
									</div>
									<div style="clear: both;"></div>
									<input type="submit" name="editar_lojista" class="btn btn-outline btn-primary" value="Atualizar"/>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">Estabelecimento</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form name="loja" autocomplete="off">
									<div class="form-group">
										<label>Nome</label>
										<input type="text" name="nome" value="<?php echo $loja;?>" class="form-control" maxlength="30">
									</div>
									<div class="form-group">
										<div class="col-md-6" style="padding-left: 0px; margin-top: 15px;">
											<label>Estado</label>
											<select name="estado" class="form-control">
												<option value="<?php echo $id_estado;?>" selected="selected"><?php echo $estado;?></option>
<?php foreach($estados as $estado): ?>
												<option value="<?php echo $estado['id'];?>"><?php echo $estado['nome'];?></option>
<?php endforeach;?>
											</select>
										</div>
										<div class="col-md-6" style="padding: 0px; margin-top: 15px;">
											<label>Cidade</label>
											<select name="cidade" id="habilitado" class="form-control">
												<option value="<?php echo $id_cidade;?>" selected="selected"><?php echo $cidade;?></option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6" style="padding-left: 0px; margin-top: 15px;">
											<label>Bairro</label>
											<input type="text" name="bairro" value="<?php echo $bairro;?>" class="form-control">
										</div>
										<div class="col-md-6" style="padding: 0; margin-top: 15px;">
											<label>Rua</label>
											<input type="text" name="rua" value="<?php echo $rua;?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6" style="padding-left: 0px; margin-top: 15px;">
											<label>Número</label>
											<input type="text" name="numero" value="<?php echo $numero;?>" class="form-control">
										</div>
									</div>
									<input type="submit" name="editar_loja" class="btn btn-outline btn-primary" value="Atualizar" style="margin-top: 40px;"/>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form name="senha" autocomplete="off">
									<div class="form-group">
										<div class="col-md-6" style="padding-left: 0px; margin-bottom: 15px;">
											<label>Nova senha</label>
											<input type="password" name="senha" class="form-control" placeholder="mínimo 8 caracteres">
										</div>
										<div class="col-md-6" style="padding: 0px; margin-bottom: 15px;">
											<label>Senha novamente</label>
											<input type="password" name="senhaconfirma" class="form-control">
										</div>
									</div>
									<div style="clear: both;"></div>
									<input type="submit" name="editar_senha" class="btn btn-outline btn-primary" value="Atualizar"/>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<script type="text/javascript" src="<?php echo $root;?>/public/jquery/jquery.min.js"></script>
			<script type="text/javascript">
			(function(g){"function"===typeof define&&define.amd?define(["jquery"],g):g(window.jQuery||window.Zepto)})(function(g){var z=function(a,e,b){var k=this,n,p;a=g(a);e="function"===typeof e?e(a.val(),void 0,a,b):e;var c={getCaret:function(){try{var d,f=0,c=a.get(0),h=document.selection,e=c.selectionStart;if(h&&!~navigator.appVersion.indexOf("MSIE 10"))d=h.createRange(),d.moveStart("character",a.is("input")?-a.val().length:-a.text().length),f=d.text.length;else if(e||"0"===e)f=e;return f}catch(b){}},setCaret:function(d){try{if(a.is(":focus")){var f,
			c=a.get(0);c.setSelectionRange?c.setSelectionRange(d,d):c.createTextRange&&(f=c.createTextRange(),f.collapse(!0),f.moveEnd("character",d),f.moveStart("character",d),f.select())}}catch(h){}},events:function(){a.on("keydown.mask",function(){n=c.val()}).on("keyup.mask",c.behaviour).on("paste.mask drop.mask",function(){setTimeout(function(){a.keydown().keyup()},100)}).on("change.mask",function(){a.data("changed",!0)}).on("blur.mask",function(){n===a.val()||a.data("changed")||a.trigger("change");a.data("changed",
			!1)}).on("focusout.mask",function(){b.clearIfNotMatch&&!p.test(c.val())&&c.val("")})},getRegexMask:function(){for(var d=[],f,a,c,b,l=0;l<e.length;l++)(f=k.translation[e[l]])?(a=f.pattern.toString().replace(/.{1}$|^.{1}/g,""),c=f.optional,(f=f.recursive)?(d.push(e[l]),b={digit:e[l],pattern:a}):d.push(c||f?a+"?":a)):d.push("\\"+e[l]);d=d.join("");b&&(d=d.replace(RegExp("("+b.digit+"(.*"+b.digit+")?)"),"($1)?").replace(RegExp(b.digit,"g"),b.pattern));return RegExp(d)},destroyEvents:function(){a.off("keydown keyup paste drop change blur focusout DOMNodeInserted ".split(" ").join(".mask ")).removeData("changeCalled")},
			val:function(d){var c=a.is("input");return 0<arguments.length?c?a.val(d):a.text(d):c?a.val():a.text()},getMCharsBeforeCount:function(d,a){for(var c=0,b=0,g=e.length;b<g&&b<d;b++)k.translation[e.charAt(b)]||(d=a?d+1:d,c++);return c},caretPos:function(d,a,b,h){return k.translation[e.charAt(Math.min(d-1,e.length-1))]?Math.min(d+b-a-h,b):c.caretPos(d+1,a,b,h)},behaviour:function(d){d=d||window.event;var a=d.keyCode||d.which;if(-1===g.inArray(a,k.byPassKeys)){var b=c.getCaret(),e=c.val(),u=e.length,l=
			b<u,q=c.getMasked(),m=q.length,n=c.getMCharsBeforeCount(m-1)-c.getMCharsBeforeCount(u-1);q!==e&&c.val(q);!l||65===a&&d.ctrlKey||(8!==a&&46!==a&&(b=c.caretPos(b,u,m,n)),c.setCaret(b));return c.callbacks(d)}},getMasked:function(a){var f=[],g=c.val(),h=0,n=e.length,l=0,q=g.length,m=1,p="push",s=-1,r,v;b.reverse?(p="unshift",m=-1,r=0,h=n-1,l=q-1,v=function(){return-1<h&&-1<l}):(r=n-1,v=function(){return h<n&&l<q});for(;v();){var w=e.charAt(h),x=g.charAt(l),t=k.translation[w];if(t)x.match(t.pattern)?(f[p](x),
			t.recursive&&(-1===s?s=h:h===r&&(h=s-m),r===s&&(h-=m)),h+=m):t.optional&&(h+=m,l-=m),l+=m;else{if(!a)f[p](w);x===w&&(l+=m);h+=m}}a=e.charAt(r);n!==q+1||k.translation[a]||f.push(a);return f.join("")},callbacks:function(d){var f=c.val(),g=f!==n;if(!0===g&&"function"===typeof b.onChange)b.onChange(f,d,a,b);if(!0===g&&"function"===typeof b.onKeyPress)b.onKeyPress(f,d,a,b);if("function"===typeof b.onComplete&&f.length===e.length)b.onComplete(f,d,a,b)}};k.remove=function(){var a;c.destroyEvents();c.val(k.getCleanVal()).removeAttr("maxlength");
			a=c.getCaret();c.setCaret(a-c.getMCharsBeforeCount(a))};k.getCleanVal=function(){return c.getMasked(!0)};k.init=function(){b=b||{};k.byPassKeys=[9,16,17,18,36,37,38,39,40,91];k.translation={0:{pattern:/\d/},9:{pattern:/\d/,optional:!0},"#":{pattern:/\d/,recursive:!0},A:{pattern:/[a-zA-Z0-9]/},S:{pattern:/[a-zA-Z]/}};k.translation=g.extend({},k.translation,b.translation);k=g.extend(!0,{},k,b);p=c.getRegexMask();!1!==b.maxlength&&a.attr("maxlength",e.length);b.placeholder&&a.attr("placeholder",b.placeholder);
			a.attr("autocomplete","off");c.destroyEvents();c.events();var d=c.getCaret();c.val(c.getMasked());c.setCaret(d+c.getMCharsBeforeCount(d,!0))}()},p={},y=function(){var a=g(this),e={};a.attr("data-mask-reverse")&&(e.reverse=!0);"false"===a.attr("data-mask-maxlength")&&(e.maxlength=!1);a.attr("data-mask-clearifnotmatch")&&(e.clearIfNotMatch=!0);a.mask(a.attr("data-mask"),e)};g.fn.mask=function(a,e){var b=this.selector,k=function(b){if(!b.originalEvent||g(b.originalEvent.relatedNode)[0]!=g(this)[0])return g(this).data("mask",
			new z(this,a,e))};this.each(k);b&&!p[b]&&(p[b]=!0,setTimeout(function(){g(document).on("DOMNodeInserted.mask",b,k)},500))};g.fn.unmask=function(){try{return this.each(function(){g(this).data("mask").remove()})}catch(a){}};g.fn.cleanVal=function(){return this.data("mask").getCleanVal()};g("*[data-mask]").each(y);g(document).on("DOMNodeInserted.mask","*[data-mask]",y)});

			if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
				var is_mobile = true;
			} else {
				var is_mobile = false;
			}
			var t = ["(00)00000-0000", "(00)0000-00009"], n = function(e, n, r, i) {return e.length > 13 ? t[0] : t[1]};
			
			$('#celular').mask(n, {
				onKeyPress: function(e, t, r, i) {
					r.mask(n(e, t, r, i), i)
				}
			});
			function formatarCNPJ(campo, teclapres){
				var tecla = teclapres.keyCode;
				var vr = new String(campo.value);
				
				vr = vr.replace('.', '');
				vr = vr.replace('/', '');
				vr = vr.replace('-', '');
				tam = vr.length + 1;
				if (tecla != 14) {
					if (tam == 3)
						campo.value = vr.substr(0, 2) + '.';
					if (tam == 6)
						campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 5) + '.';
					if (tam == 10)
						campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 3) + '.' + vr.substr(6, 3) + '/';
					if (tam == 15)
						campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 3) + '.' + vr.substr(6, 3) + '/' + vr.substr(9, 4) + '-' + vr.substr(13, 2);
				}
			}
			function validarCNPJ(cnpj){
				cnpj = cnpj.replace(/[^\d]+/g,'');
				if (cnpj == '') return false;
				if (cnpj.length != 14)
					return false;
				if (cnpj == "00000000000000" ||
				   cnpj == "11111111111111" ||
				   cnpj == "22222222222222" ||
				   cnpj == "33333333333333" ||
				   cnpj == "44444444444444" ||
				   cnpj == "55555555555555" ||
				   cnpj == "66666666666666" ||
				   cnpj == "77777777777777" ||
				   cnpj == "88888888888888" ||
				   cnpj == "99999999999999")
				   return false;
				tamanho = cnpj.length - 2
				numeros = cnpj.substring(0,tamanho);
				digitos = cnpj.substring(tamanho);
				soma = 0;
				pos = tamanho - 7;
				for (i = tamanho; i >= 1; i--) {
				  soma += numeros.charAt(tamanho - i) * pos--;
				  if (pos < 2)
						pos = 9;
				}
				resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
				if (resultado != digitos.charAt(0))
					return false;
				tamanho = tamanho + 1;
				numeros = cnpj.substring(0,tamanho);
				soma = 0;
				pos = tamanho - 7;
				for (i = tamanho; i >= 1; i--) {
				  soma += numeros.charAt(tamanho - i) * pos--;
				  if (pos < 2)
					 pos = 9;
				}
				resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
				if (resultado != digitos.charAt(1))
				   return false;
				return true;
			}
			</script>