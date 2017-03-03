<!DOCTYPE html>
<html lang="pt-BR" class="no-js">
<head>
	<title>Nome da loja</title>
	<meta charset="utf-8">
	<meta name="robots" content="noindex, nofollow">
	<meta name="robots" content="nofollow">
	<meta name="googlebot" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="shortcut icon" href="<?php echo $root;?>/public/img/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $root;?>/public/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $root;?>/public/css/sb-admin.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $root;?>/public/css/menu.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $root;?>/public/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $root;?>/public/css/input-file.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $root;?>/public/css/jquery-confirm.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $root;?>/public/css/iziToast.css"/>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand">Nome da loja</div>
            </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li><a href="<?php echo $root;?>/admin/inicio"><i class="fa fa-home fa-fw"></i> Página inicial</a></li>
                        <li><a href="<?php echo $root;?>/admin/dados"><i class="fa fa-cogs fa-fw"></i> Configurações</a></li>
                        <li>
							<a href="javascript:void(0)"><i class="fa fa-shopping-cart fa-fw"></i> Produtos<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="<?php echo $root;?>/admin/cadastrar/produto">Cadastrar</a></li>
								<li><a href="<?php echo $root;?>/admin/listar/produtos/esgotados">Em falta</a></li>
								<li><a href="<?php echo $root;?>/admin/listar/produtos">Listar</a></li>
							</ul>
                        </li>
                        <li><a href="<?php echo $root;?>/admin/listar/pedidos"><i class="fa fa-exclamation-circle fa-fw"></i> Pedidos</a></li>
                        <li><a id="sair" href="<?php echo $root;?>/sair"><i class="fa fa-sign-out fa-fw"></i> Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>
		<div id="page-wrapper">
		<span class="root" id="<?php echo $root;?>:<?php echo $_SESSION['token'];?>:<?php echo $_SESSION['acesso_loja'];?>"></span><br/>
