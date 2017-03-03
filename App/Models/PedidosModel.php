<?php
	namespace App\Models;
    use App\Models\Model;
	
	class PedidosModel extends Model
	{
        public function pedidos(){
            $args = func_get_args();
			
            if (count($args) == 0) {
				try {
					$stmt = $this->db->prepare("SELECT * FROM `loja_pedidos` WHERE `id_loja` = :loja ORDER BY `id` DESC");
					$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
					$stmt->execute();
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
				} catch(\PDOException $e) {
					die($e->getMessage());
				}
            } elseif(count($args) == 1 && is_array($args[0])) {
                $offset = $args[0]['inicio'];
                $max = $args[0]['limite'];
				
				try {
					$stmt = $this->db->prepare("SELECT * FROM `loja_pedidos` WHERE `id_loja` = :loja ORDER BY `id` DESC LIMIT :offset, :max");
					$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
					$stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
					$stmt->bindValue(':max', $max, \PDO::PARAM_INT);
					$stmt->execute();
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
				} catch(\PDOException $e) {
					die($e->getMessage());
				}
            }
        }
		
		public function detalhes($id){
			try {
				$stmt = $this->db->prepare("SELECT loja_pedidos.id as id_pedido, loja_pedidos.pontos as pontos_pedido, loja_pedidos.status as status_pedido, loja_pedidos.data as data_pedido, loja_produtos.nome as nome_produto, loja_clientes.id as id_cliente, loja_clientes.nome as nome_cliente FROM `loja_produtos_pedidos` INNER JOIN `loja_pedidos` ON (loja_pedidos.id = loja_produtos_pedidos.id_pedido) INNER JOIN `loja_clientes` ON (loja_clientes.id = loja_pedidos.id_cliente) INNER JOIN `loja_produtos` ON (loja_produtos.id = loja_produtos_pedidos.id_produto) WHERE loja_pedidos.id_loja = :loja AND loja_pedidos.id = :id");
				$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
				$stmt->bindValue(':id', $id, \PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll(\PDO::FETCH_ASSOC);
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function status(){
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
			$status = filter_input(INPUT_POST, 'statusPedido', FILTER_SANITIZE_NUMBER_INT);
			
			try {
				$stmt = $this->db->prepare("UPDATE `loja_pedidos` SET `status` = :status WHERE `id_loja` = :loja AND `id` = :id");
				$stmt->bindValue(':status', $status, \PDO::PARAM_INT);
				$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
				$stmt->bindValue(':id', $id, \PDO::PARAM_INT);
				if ($stmt->execute()) {
					$retorno['resposta'] = 'atualizou';
					return $retorno;
				}
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function cancelar(){
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
			
			try {
				$stmt = $this->db->prepare("");
				$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
				$stmt->bindValue(':id', $id, \PDO::PARAM_INT);
				if ($stmt->execute()) {
					$retorno['resposta'] = 'cancelou';
					return $retorno;
				}
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
	}