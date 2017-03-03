<?php
	namespace App\Controllers;
	use App\Controllers\Controller;
	use App\Models\CategoriasModel as Categorias;
	use App\Models\ProdutosModel as Produtos;
	use App\Models\FotosModel as Fotos;
	use App\Helpers\Paginacao;
	
	class ProdutosController extends Controller
	{
		public function pagina(){
			if (isset($_SESSION['acesso_loja'])) {
				if (isset($_SESSION['produto'])) {
					$this->router->redirectTo('fotos');
				} else {
					$categorias = new Categorias($this->db);
					$registros = $categorias->categorias();
					
					$this->render->setHf('loja/header.php', 'loja/footer.php');
					$this->render->load('loja/cadastrar_produto.php', ['registros' => $registros]);
				}
			} else {
				$this->router->redirectTo('login_loja');
			}
		}
		
		public function produtos(){
			if (isset($_SESSION['acesso_loja'])) {
				$produtos = new Produtos($this->db);
				$total = count($produtos->produtos());
				$link = $this->container->router->pathFor('produtos');
				$limite = 10;
				$paginacao = new Paginacao($total, $link, $limite);
				$registros = $produtos->produtos(['inicio' => $paginacao->offset(), 'limite' => $limite]);
				
				$this->render->setHf('loja/header.php', 'loja/footer.php');
				$this->render->load('loja/produtos.php', ['registros' => $registros, 'links' => $paginacao->links()]);
			} else {
				$this->router->redirectTo('login_loja');
			}
		}
		
		public function esgotados(){
			if (isset($_SESSION['acesso_loja'])) {
				$produtos = new Produtos($this->db);
				$total = count($produtos->esgotados());
				$link = $this->container->router->pathFor('esgotados');
				$limite = 10;
				$paginacao = new Paginacao($total, $link, $limite);
				$registros = $produtos->esgotados(['inicio' => $paginacao->offset(), 'limite' => $limite]);
				
				$this->render->setHf('loja/header.php', 'loja/footer.php');
				$this->render->load('loja/esgotados.php', ['registros' => $registros, 'links' => $paginacao->links()]);
			} else {
				$this->router->redirectTo('login_loja');
			}
		}
		
		public function cadastro($dados){
			if($dados['token'] == $_SESSION['token']):
				$cadastro = new Produtos($this->db);
				$resposta = $cadastro->cadastro($dados);
				echo json_encode($resposta);
			endif;
		}
		
		public function produto($id){
			if (isset($_SESSION['acesso_loja'])) {
				$conta = new Fotos($this->db);
				$produto = new Produtos($this->db);
				$categorias = new Categorias($this->db);
				$fotos = $conta->fotos($id);
				$dados = $produto->produto($id);
				$registros = $categorias->categorias();
				$quantidade = count($fotos);
				$falta = 3 - $quantidade;
				
				$this->render->setHf('loja/header.php', 'loja/footer.php');
				$this->render->load('loja/editar_produto.php', ['registros' => $registros, 'id' => $dados[0]['id'], 'nome' => $dados[0]['nome'], 'id_categoria' => $dados[0]['id_categoria'], 'categoria' => $dados[0]['categoria'], 'id_subcategoria' => $dados[0]['id_subcategoria'], 'subcategoria' => $dados[0]['subcategoria'], 'preco' => $dados[0]['preco'], 'estoque' => $dados[0]['estoque'], 'falta' => $falta, 'fotos' => $fotos]);
			} else {
				$this->router->redirectTo('login_loja');
			}
		}
		
		public function produto_estoque($id){
			if (isset($_SESSION['acesso_loja'])) {
				$produto = new Produtos($this->db);
				$dados = $produto->produto($id);
				
				$this->render->setHf('loja/header.php', 'loja/footer.php');
				$this->render->load('loja/editar_produto_estoque.php', ['id' => $dados[0]['id'], 'produto' => $dados[0]['nome'], 'estoque' => $dados[0]['estoque']]);
			} else {
				$this->router->redirectTo('login_loja');
			}
		}
		
		public function editar($dados){
			if($dados['token'] == $_SESSION['token']):
				$produto = new Produtos($this->db);
				$resposta = $produto->editar($dados);
				echo json_encode($resposta);
			endif;
		}
		
		public function editar_estoque($dados){
			if($dados['token'] == $_SESSION['token']):
				$produto = new Produtos($this->db);
				$resposta = $produto->editar_estoque($dados);
				echo json_encode($resposta);
			endif;
		}
		
		public function excluir($dados){
			if($dados['token'] == $_SESSION['token']):
				$excluir = new Produtos($this->db);
				$resposta = $excluir->excluir($dados);
				echo json_encode($resposta);
			endif;
		}
	}