<?php
	namespace App\Models;
    use App\Models\Model;
    use App\Helpers\Email;
	
	class EmailModel extends Model
	{
		public function esqueci_senha(){
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			
			try {
				$stmt = $this->db->prepare("SELECT `nome` FROM loja_lojistas WHERE `email` = :email");
				$stmt->bindValue(':email', $email, \PDO::PARAM_STR);
				$stmt->execute();
				$dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				if (count($dados) > 0) {
					$codigo = base64_encode($email);
					$data_expira = date('Y-m-d H:i:s', strtotime('+1 day'));
					
					$retorno = $this->cadastrar($dados[0]['nome'], $email, $codigo, $data_expira);					
				} else {
					$retorno['resposta'] = 'nao_encontrado';
				}
				$_SESSION['token'] = hash('sha512', rand(10, 1000));
				$retorno['token'] = $_SESSION['token'];
				
				return $retorno;
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function cadastrar($nome, $email, $codigo, $data_expira){
			try {
				$stmt = $this->db->prepare("INSERT INTO `loja_codigo_email` (`codigo`, `data`) VALUES (:codigo, :data)");
				$stmt->bindValue(':codigo', $codigo, \PDO::PARAM_STR);
				$stmt->bindValue(':data', $data_expira, \PDO::PARAM_STR);
				if ($stmt->execute()) {
					$url = '/redefinir&token='.$codigo;
					$mensagem = '<h2>Esqueci minha senha :(</h2><p>Olá <strong>'.$nome.'</strong>, foi solicitado ajuda para lembrar sua senha para login em nosso site, não podemos enviar a senha por e-mail pois ela é criptografada para sua segurança, <strong>MAS</strong> você pode trocar a senha clicando no link abaixo. Se você não solicitou recuperar sua senha, por favor desconsidere este e-mail!</p><p><a href="'.$url.'" target="_blank">Clique aqui</a></p><br/><p>Atenciosamente, <strong>Pague com Pontos</strong></p><br/><p>Mensagem enviada dia <strong>'.date('d/m/Y H:i').'</strong></p>';
					
					$enviar = new Email('Esqueci minha senha', $mensagem, 'teste@bol.com.br', 'EMPRESA', $email, $nome);
                    $retorno = $enviar->enviar();
					return $retorno;
				}
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
	}
