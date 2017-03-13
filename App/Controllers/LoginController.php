<?php
	namespace App\Controllers;
	//use App\Controllers\Controller;
	use App\Models\LoginModel as Login;
	use App\Models\EmailModel as Email;
	use App\Session;
	
	class LoginController extends Controller
	{
		public function pagina(){
			if (Session::get('acesso_loja')) {
				$this->router->redirectTo('inicio');
			} else {
				$this->render->load('loja/login.php', [], false);
			}
		}
		
		public function login($dados){
			//if($dados['token'] == $_SESSION['token']):
				$login = new Login($this->db);
				$resposta = $login->login($dados);
				echo json_encode($resposta);
			//endif;
		}
		
		public function sair(){
			if (Session::get('acesso_loja')) {
				Session::destroy('acesso_loja');
				$this->router->redirectTo('login_loja');
			}
		}
		
		public function senha(){
			$this->render->load('loja/esqueci_senha.php', [], false);
		}
		
		public function enviar_email($dados){
			if($dados['token'] == $_SESSION['token']):
				$email = new Email($this->db);
				$resposta = $email->esqueci_senha($dados);
				echo json_encode($resposta);
			endif;
		}
	}