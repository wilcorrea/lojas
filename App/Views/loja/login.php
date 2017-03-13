<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>Administração</title>
	<meta charset="utf-8">
	<meta name="robots" content="noindex, nofollow">
	<meta name="robots" content="nofollow">
	<meta name="googlebot" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="stylesheet" type="text/css" href="<?php echo $root; ?>/public/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $root; ?>/public/css/sb-admin.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $root; ?>/public/css/iziToast.css"/>
</head>
<body>
<div class="container">
<span class="root" id="<?php echo $root; ?>:<?php echo $_SESSION['token']; ?>"></span>
	<div class="row">
		<div class="logo"></div>
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Acesso restrito</h3>
				</div>
				<div class="panel-body">
					<form name="loja" autocomplete="off">
						<fieldset>
							<div class="form-group" style="margin-bottom: 15px;">
								<input type="email" name="email" value="teste@live.com" placeholder="E-mail" class="form-control"/>
							</div>
							<div class="form-group" style="margin-bottom: 15px;">
								<input type="password" name="senha" value="teste" placeholder="Senha" class="form-control"/>
							</div>
							<div class="form-group" style="margin-bottom: 15px;">
								<label><input type="checkbox" name="lembrar"/> Lembrar</label>
							</div>
							<input type="submit" name="logar_loja" value="Entrar" class="btn btn-lg btn-success btn-block"/>
						</fieldset>
					</form>
				</div>
			</div>
			<a href="<?php echo $root; ?>/admin/senha">Esqueci a senha</a>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo $root; ?>/public/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $root; ?>/public/js/login.js"></script>
<script type="text/javascript" src="<?php echo $root; ?>/public/js/iziToast.min.js"></script>
</body>
</html>