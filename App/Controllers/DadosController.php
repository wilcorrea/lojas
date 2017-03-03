<?php
	namespace App\Controllers;
	use App\Controllers\Controller;
	use App\Models\DadosModel as Dados;
	use App\Models\CategoriasModel as Estados;
	
	class DadosController extends Controller
	{
		// Loja
		public function pagina_loja(){
			if (isset($_SESSION['acesso_loja'])) {
				$estados = new Estados($this->db);
				$dados = new Dados($this->db);
				$lojista = $dados->lojista();
				$estados = $estados->estados();
				
				$this->render->setHf('loja/header.php', 'loja/footer.php');
				$this->render->load('loja/dados.php', ['nome' => $lojista[0]['nome'], 'sobrenome' => $lojista[0]['sobrenome'], 'cpf' => $lojista[0]['cpf'], 'cnpj' => $lojista[0]['cnpj'], 'email' => $lojista[0]['email'], 'telefone' => $lojista[0]['telefone'], 'estados' => $estados, 'id_estado' => $lojista[0]['id_estado'], 'estado' => $lojista[0]['nome_estado'], 'loja' => $lojista[0]['nome_loja'], 'id_cidade' => $lojista[0]['id_cidade'], 'cidade' => $lojista[0]['nome_cidade'], 'bairro' => $lojista[0]['bairro'], 'rua' => $lojista[0]['rua'], 'numero' => $lojista[0]['numero']]);
			} else {
				$this->router->redirectTo('login_loja');
			}
		}
		
		public function editar_lojista($dados){
			if($dados['token'] == $_SESSION['token']):
				$lojista = new Dados($this->db);
				$resposta = $lojista->editar_lojista($dados);
				echo json_encode($resposta);
			endif;
		}
		
		public function editar_loja($dados){
			if($dados['token'] == $_SESSION['token']):
				$loja = new Dados($this->db);
				$resposta = $loja->editar_loja($dados);
				echo json_encode($resposta);
			endif;
		}
		
		public function editar_senha_loja($dados){
			if($dados['token'] == $_SESSION['token']):
				$senha = new Dados($this->db);
				$resposta = $senha->editar_senha_loja($dados);
				echo json_encode($resposta);
			endif;
		}
		
		// Admin
		public function pagina_admin(){
			if (isset($_SESSION['acesso_admin'])) {
				$dados = new Dados($this->db);
				$admin = $dados->admin();
				
				$this->render->setHf('admin/header.php', 'admin/footer.php');
				$this->render->load('admin/dados.php', ['email' => $admin[0]['email']]);
			} else {
				$this->router->redirectTo('login_admin');
			}
		}
		
		public function editar_admin($dados){
			if($dados['token'] == $_SESSION['token']):
				$admin = new Dados($this->db);
				$resposta = $admin->editar_admin($dados);
				echo json_encode($resposta);
			endif;
		}
		
		public function editar_senha_admin($dados){
			if($dados['token'] == $_SESSION['token']):
				$senha = new Dados($this->db);
				$resposta = $senha->editar_senha_admin($dados);
				echo json_encode($resposta);
			endif;
		}
	}