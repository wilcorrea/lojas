<?php
	namespace App\Models;
    use App\Models\Model;
	
	class DadosModel extends Model
	{
		// Loja
		public function lojista(){
			try {
				$stmt = $this->db->prepare("SELECT `l`.nome as nome_loja, `l`.estado as id_estado, `l`.cidade as id_cidade, `l`.bairro, `l`.rua, `l`.numero, `a`.nome, `a`.sobrenome, `a`.cpf, `a`.cnpj, `a`.email, `a`.telefone, `e`.nome as nome_estado, `c`.nome as nome_cidade FROM loja_lojistas as a INNER JOIN admin_lojas as l ON `l`.`id_loja` = `a`.`id` INNER JOIN admin_estados as e ON `e`.`id` = `l`.`estado` INNER JOIN admin_cidades as c ON `c`.`id` = `l`.`cidade` WHERE `a`.`id` = :loja");
				$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll(\PDO::FETCH_ASSOC);
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function editar_loja(){
			$rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
			$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
			$bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
			$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_NUMBER_INT);
			$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_NUMBER_INT);
			$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT);
			
			try {
				$stmt = $this->db->prepare("UPDATE `admin_lojas` SET `nome` = :nome, `estado` = :estado, `cidade` = :cidade, `bairro` = :bairro, `rua` = :rua, `numero` = :numero WHERE `id_loja` = :loja");
				$stmt->bindValue(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindValue(':estado', $estado, \PDO::PARAM_INT);
				$stmt->bindValue(':cidade', $cidade, \PDO::PARAM_INT);
				$stmt->bindValue(':bairro', $bairro, \PDO::PARAM_STR);
				$stmt->bindValue(':rua', $rua, \PDO::PARAM_STR);
				$stmt->bindValue(':numero', $numero, \PDO::PARAM_INT);
				$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
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
		
		public function editar_lojista(){
			$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
			$cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
			$sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
			
			$cnpj = preg_replace('/[^0-9]/', '', $cnpj);
			$telefone = preg_replace('/[^0-9]/', '', $telefone);
			
			try {
				$stmt = $this->db->prepare("UPDATE `loja_lojistas` SET `nome` = :nome, `sobrenome` = :sobrenome, `cnpj` = :cnpj, `telefone` = :telefone, `email` = :email WHERE `id` = :loja");
				$stmt->bindValue(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindValue(':sobrenome', $sobrenome, \PDO::PARAM_STR);
				$stmt->bindValue(':cnpj', $cnpj, \PDO::PARAM_STR);
				$stmt->bindValue(':telefone', $telefone, \PDO::PARAM_STR);
				$stmt->bindValue(':email', $email, \PDO::PARAM_STR);
				$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
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
		
		public function editar_senha_loja(){
			$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
			
			$senha_criptografada = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);
			
			try {
				$stmt = $this->db->prepare("UPDATE `loja_lojistas` SET `senha` = :senha WHERE `id` = :loja");
				$stmt->bindValue(':senha', $senha_criptografada, \PDO::PARAM_STR);
				$stmt->bindValue(':loja', $_SESSION['acesso_loja'], \PDO::PARAM_INT);
				if ($stmt->execute()) {
					unset($_SESSION['acesso_loja']);
					$_SESSION['token'] = hash('sha512', rand(10, 1000));
					$retorno['resposta'] = 'atualizou';
					$retorno['token'] = $_SESSION['token'];
					return $retorno;
				}
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		// Admin
		public function admin(){
			try {
				$stmt = $this->db->prepare("SELECT `email` FROM admin WHERE `id` = :admin");
				$stmt->bindValue(':admin', $_SESSION['acesso_admin'], \PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll(\PDO::FETCH_ASSOC);
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function editar_admin(){
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			
			try {
				$stmt = $this->db->prepare("UPDATE `admin` SET `email` = :email WHERE `id` = :admin");
				$stmt->bindValue(':email', $email, \PDO::PARAM_STR);
				$stmt->bindValue(':admin', $_SESSION['acesso_admin'], \PDO::PARAM_INT);
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
		
		public function editar_senha_admin(){
			$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
			
			$senha_criptografada = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);
			
			try {
				$stmt = $this->db->prepare("UPDATE `admin` SET `senha` = :senha WHERE `id` = :admin");
				$stmt->bindValue(':senha', $senha_criptografada, \PDO::PARAM_STR);
				$stmt->bindValue(':admin', $_SESSION['acesso_admin'], \PDO::PARAM_INT);
				if ($stmt->execute()) {
					unset($_SESSION['acesso_admin']);
					$_SESSION['token'] = hash('sha512', rand(10, 1000));
					$retorno['resposta'] = 'atualizou';
					$retorno['token'] = $_SESSION['token'];
					return $retorno;
				}
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
	}