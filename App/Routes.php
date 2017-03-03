<?php
	$app->get('/admin', 'App\Controllers\LoginController:pagina')->setName('login_loja');
	$app->post('/admin', function(){
		App\Controllers\LoginController::login($this->request->getParsedBody());
	});
	
    $app->group('/admin', function() use ($app){
		$app->get('/inicio', 'App\Controllers\HomeController:acesso_loja')->setName('inicio');
		$app->get('/dados', 'App\Controllers\DadosController:pagina_loja');
		$app->get('/cadastrar/produto', 'App\Controllers\ProdutosController:pagina')->setName('cadastro');
		$app->post('/cadastrar/produto', function(){
			App\Controllers\ProdutosController::cadastro($this->request->getParsedBody());
		});
		$app->get('/cadastrar/produto/fotos', 'App\Controllers\FotosController:pagina')->setName('fotos');
		$app->post('/cadastrar/foto', function(){
			App\Controllers\FotosController::cadastro($this->request->getParsedBody());
		});
		$app->get('/listar/produtos/esgotados', 'App\Controllers\ProdutosController:esgotados')->setName('esgotados');
		$app->get('/listar/produtos', 'App\Controllers\ProdutosController:produtos')->setName('produtos');
        $app->get('/editar/produto/:id', function($id){
			App\Controllers\ProdutosController::produto($id);
        });
        $app->post('/editar/produto', function(){
			App\Controllers\ProdutosController::editar($this->request->getParsedBody());
        });
        $app->post('/excluir/produto', function(){
			App\Controllers\ProdutosController::excluir($this->request->getParsedBody());
        });
        $app->post('/excluir/foto', function(){
			App\Controllers\FotosController::excluir($this->request->getParsedBody());
        });
        $app->post('/finalizar', function(){
			App\Controllers\FotosController::finalizar();
        });
        $app->get('/estoque/produto/:id', function($id){
			App\Controllers\ProdutosController::produto_estoque($id);
        });
        $app->post('/estoque/produto', function(){
			App\Controllers\ProdutosController::editar_estoque($this->request->getParsedBody());
        });
		$app->get('/listar/pedidos', 'App\Controllers\PedidosController:pedidos')->setName('pedidos');
		$app->get('/detalhes/pedido/:id', function($id){
			App\Controllers\PedidosController::detalhes($id);
		});
		$app->post('/atualizar/status', function(){
			App\Controllers\PedidosController::status($this->request->getParsedBody());
		});
		$app->post('/cancelar/pedido', function(){
			App\Controllers\PedidosController::cancelar($this->request->getParsedBody());
		});
        $app->post('/editar/loja', function(){
			App\Controllers\DadosController::editar_loja($this->request->getParsedBody());
        });
        $app->post('/editar/lojista', function(){
			App\Controllers\DadosController::editar_lojista($this->request->getParsedBody());
        });
        $app->post('/editar/senha', function(){
			App\Controllers\DadosController::editar_senha_loja($this->request->getParsedBody());
        });
		$app->get('/senha', 'App\Controllers\LoginController:senha');
        $app->post('/esqueci/senha', function(){
			App\Controllers\LoginController::enviar_email($this->request->getParsedBody());
        });
    });
		
	$app->post('/combo/categoria', function(){
		App\Controllers\ComboController::categoria($this->request->getParsedBody());
	});
	$app->post('/combo/estado', function(){
		App\Controllers\ComboController::estado($this->request->getParsedBody());
	});
	$app->get('/sair', function(){
		App\Controllers\LoginController::sair();
	});