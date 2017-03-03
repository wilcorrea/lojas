<?php
	namespace App\Controllers;
	use App\Controllers\Controller;
	use App\Models\PedidosModel as Pedidos;
	use App\Helpers\Paginacao;
	
	class PedidosController extends Controller
	{
		public function pedidos(){
			if (isset($_SESSION['acesso_loja'])) {
				$pedidos = new Pedidos($this->db);
				$total = count($pedidos->pedidos());
				$link = $this->container->router->pathFor('pedidos');
				$limite = 10;
				$paginacao = new Paginacao($total, $link, $limite);
				$registros = $pedidos->pedidos(['inicio' => $paginacao->offset(), 'limite' => $limite]);
				
				$this->render->setHf('loja/header.php', 'loja/footer.php');
				$this->render->load('loja/pedidos.php', ['registros' => $registros, 'links' => $paginacao->links()]);
			} else {
				$this->router->redirectTo('login_loja');
			}
		}
		
		public function detalhes($id){
			if (isset($_SESSION['acesso_loja'])) {
				$detalhes = new Pedidos($this->db);
				$dados = $detalhes->detalhes($id);
				switch($dados[0]['status_pedido']){
					case 0:
						$status = 'Pendente'; break;
					case 1:
						$status = 'Aguardando busca'; break;
					case 2:
						$status = 'Produto entregue'; break;
				}
				
				$this->render->setHf('loja/header.php', 'loja/footer.php');
				$this->render->load('loja/detalhes_pedido.php', [
					// Pedido
					'id_pedido' => $dados[0]['id_pedido'],
					'pontos' => $dados[0]['pontos_pedido'],
					'status' => $status,
					'data' => $dados[0]['data_pedido'],
					
					// Cliente
					'id_cliente' => $dados[0]['id_cliente'],
					'cliente' => $dados[0]['nome_cliente'],
					
					// Produto
					'produto' => $dados[0]['nome_produto']
				]);
			} else {
				$this->router->redirectTo('login_loja');
			}
		}
		
		public function status($dados){
			$status = new Pedidos($this->db);
			$dados = $status->status($dados);
			echo json_encode($dados);
		}
		
		public function cancelar($dados){
			$cancelar = new Pedidos($this->db);
			$dados = $cancelar->cancelar($dados);
			echo json_encode($dados);
		}
	}