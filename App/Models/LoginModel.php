<?php
	namespace App\Models;
	use App\Session;
	use App\Cookie;
	
	class LoginModel extends Model
	{
		public function login(){
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
			$remember = filter_input(INPUT_POST, 'lembrar', FILTER_SANITIZE_STRING);
			
			$stmt = $this->db->prepare("SELECT `a`.`liberado`, `l`.`id`, `l`.`senha` FROM loja_lojistas as l INNER JOIN admin_lojas as a ON `a`.`id_loja` = `l`.`id` WHERE `l`.`email` = :email");
			$stmt->bindValue(':email', $email, \PDO::PARAM_STR);
			$stmt->execute();
			$dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			if (count($dados) == 1 AND $dados[0]['liberado'] == 1) {
				if (password_verify($senha, $dados[0]['senha'])) {
					$token = Session::create(['acesso_loja' => $dados[0]['id']]);
					if($remember):
						Cookie::set('__dmz', $token);
					endif;
					
					$retorno['resposta'] = 'logou';
				}
			} elseif(count($dados) == 1 AND $dados[0]['liberado'] == 0) {
				$retorno['resposta'] = 'expirou';
			} else {
				$retorno['resposta'] = 'login_invalido';
			}
			$_SESSION['token'] = hash('sha512', rand(10, 1000));
			$retorno['token'] = $_SESSION['token'];
			return $retorno;
		}
	}