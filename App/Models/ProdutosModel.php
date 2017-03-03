<?php
	namespace App\Models;
    use App\Models\Model;
	
	class ProdutosModel extends Model
	{
        public function produtos(){
            $args = func_get_args();
			
            if (count($args) == 0) {
				try {
					$stmt = $this->db->prepare("SELECT * FROM `loja_produtos` WHERE `id_loja` = :loja AND `estoque` > :estoque ORDER BY `id` DESC");
					$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
					$stmt->bindValue(':estoque', 0, \PDO::PARAM_INT);
					$stmt->execute();
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
				} catch(\PDOException $e) {
					die($e->getMessage());
				}
            } elseif(count($args) == 1 && is_array($args[0])) {
                $offset = $args[0]['inicio'];
                $max = $args[0]['limite'];
				
				try {
					$stmt = $this->db->prepare("SELECT * FROM `loja_produtos` WHERE `id_loja` = :loja AND `estoque` > :estoque ORDER BY `id` DESC LIMIT :offset, :max");
					$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
					$stmt->bindValue(':estoque', 0, \PDO::PARAM_INT);
					$stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
					$stmt->bindValue(':max', $max, \PDO::PARAM_INT);
					$stmt->execute();
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
				} catch(\PDOException $e) {
					die($e->getMessage());
				}
            }
        }
		
        public function esgotados(){
            $args = func_get_args();
			
            if (count($args) == 0) {
				try {
					$stmt = $this->db->prepare("SELECT * FROM `loja_produtos` WHERE `id_loja` = :loja AND `estoque` = :estoque ORDER BY `id` DESC");
					$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
					$stmt->bindValue(':estoque', 0, \PDO::PARAM_INT);
					$stmt->execute();
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
				} catch(\PDOException $e) {
					die($e->getMessage());
				}
            } elseif(count($args) == 1 && is_array($args[0])) {
                $offset = $args[0]['inicio'];
                $max = $args[0]['limite'];
				
				try {
					$stmt = $this->db->prepare("SELECT * FROM `loja_produtos` WHERE `id_loja` = :loja AND `estoque` = :estoque ORDER BY `id` DESC LIMIT :offset, :max");
					$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
					$stmt->bindValue(':estoque', 0, \PDO::PARAM_INT);
					$stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
					$stmt->bindValue(':max', $max, \PDO::PARAM_INT);
					$stmt->execute();
					return $stmt->fetchAll(\PDO::FETCH_ASSOC);
				} catch(\PDOException $e) {
					die($e->getMessage());
				}
            }
        }
		
		public function cadastro(){
			$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
			$preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_INT);
			$estoque = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_NUMBER_INT);
			$categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT);
			$subcategoria = filter_input(INPUT_POST, 'subcategoria', FILTER_SANITIZE_NUMBER_INT);
			
			$stmt = $this->db->prepare("SELECT `nome` FROM `loja_produtos` WHERE `nome` = :nome");
			$stmt->bindValue(':nome', $nome, \PDO::PARAM_STR);
			$stmt->execute();
			$conta = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			if (count($conta) > 0) {
				$_SESSION['token'] = hash('sha512', rand(10, 1000));
				$retorno['resposta'] = 'existe';
				$retorno['token'] = $_SESSION['token'];
				return $retorno;
			} else {
				try {
					$stmt = $this->db->prepare("INSERT INTO `loja_produtos` (`id_loja`, `id_categoria`, `id_subcategoria`, `nome`, `preco`, `estoque`) VALUES (:loja, :categoria, :subcategoria, :nome, :preco, :estoque)");
					$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
					$stmt->bindValue(':categoria', $categoria, \PDO::PARAM_INT);
					$stmt->bindValue(':subcategoria', $subcategoria, \PDO::PARAM_INT);
					$stmt->bindValue(':nome', $nome, \PDO::PARAM_STR);
					$stmt->bindValue(':preco', $preco, \PDO::PARAM_INT);
					$stmt->bindValue(':estoque', $estoque, \PDO::PARAM_INT);
					if ($stmt->execute()) {
						$_SESSION['token'] = hash('sha512', rand(10, 1000));
						$_SESSION['produto'] = $this->db->lastInsertId();
						$retorno['resposta'] = 'cadastrou';
						$retorno['token'] = $_SESSION['token'];
						return $retorno;
					}
				} catch(\PDOException $e) {
					die($e->getMessage());
				}
			}
		}
		
        public function produto($id){
			try {
				$stmt = $this->db->prepare("SELECT `c`.*, `s`.*, `p`.* FROM loja_produtos as p INNER JOIN admin_categorias as c ON `c`.`id` = `p`.`id_categoria` INNER JOIN admin_subcategorias as s ON `s`.`id` = `p`.`id_subcategoria` WHERE `p`.`id_loja` = :loja AND `p`.`id` = :produto");
				$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
				$stmt->bindValue(':produto', $id, \PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll(\PDO::FETCH_ASSOC);
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
        }
		
		public function editar(){
			$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
			$produto = filter_input(INPUT_POST, 'produto', FILTER_SANITIZE_NUMBER_INT);
			$estoque = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_NUMBER_INT);
			$categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT);
			$subcategoria = filter_input(INPUT_POST, 'subcategoria', FILTER_SANITIZE_NUMBER_INT);
			
			try {
				$stmt = $this->db->prepare("UPDATE `loja_produtos` SET `id_categoria` = :categoria, `id_subcategoria` = :subcategoria, `nome` = :nome, `estoque` = :estoque WHERE `id_loja` = :loja AND `id` = :produto");
				$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
				$stmt->bindValue(':produto', $produto, \PDO::PARAM_INT);
				$stmt->bindValue(':categoria', $categoria, \PDO::PARAM_INT);
				$stmt->bindValue(':subcategoria', $subcategoria, \PDO::PARAM_INT);
				$stmt->bindValue(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindValue(':estoque', $estoque, \PDO::PARAM_INT);
				if ($stmt->execute()) {
					$_SESSION['token'] = hash('sha512', rand(10, 1000));
					$retorno['resposta'] = 'atualizou';
					$retorno['token'] = $_SESSION['token'];
					return $retorno;
				}
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function editar_estoque(){
			$produto = filter_input(INPUT_POST, 'produto', FILTER_SANITIZE_NUMBER_INT);
			$estoque = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_NUMBER_INT);
			
			try {
				$stmt = $this->db->prepare("UPDATE `loja_produtos` SET `estoque` = :estoque WHERE `id_loja` = :loja AND `id` = :produto");
				$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
				$stmt->bindValue(':produto', $produto, \PDO::PARAM_INT);
				$stmt->bindValue(':estoque', $estoque, \PDO::PARAM_INT);
				if ($stmt->execute()) {
					$_SESSION['token'] = hash('sha512', rand(10, 1000));
					$retorno['resposta'] = 'atualizou';
					$retorno['token'] = $_SESSION['token'];
					return $retorno;
				}
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function excluir(){
			$produto = filter_input(INPUT_POST, 'produto', FILTER_SANITIZE_NUMBER_INT);
			
			try {
				$stmt = $this->db->prepare("DELETE FROM `loja_produtos` WHERE `id_loja` = :loja AND `id` = :produto");
				$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
				$stmt->bindValue(':produto', $produto, \PDO::PARAM_INT);
				if ($stmt->execute()) {
					$_SESSION['token'] = hash('sha512', rand(10, 1000));
					$retorno['resposta'] = 'excluiu';
					$retorno['token'] = $_SESSION['token'];
					return $retorno;
				}
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
	}