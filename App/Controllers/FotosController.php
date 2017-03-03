<?php
	namespace App\Controllers;
	use App\Controllers\Controller;
	use App\Models\FotosModel as Fotos;
	
	class FotosController extends Controller
	{
		public function pagina(){
			if(isset($_SESSION['acesso_loja']) AND isset($_SESSION['produto'])):
				$conta = new Fotos($this->db);
				$fotos = $conta->fotos($_SESSION['produto']);
				$quantidade = count($fotos);
				$falta = 3 - $quantidade;
				if($quantidade != 6):
					$this->render->setHf('loja/header.php', 'loja/footer.php');
					$this->render->load('loja/cadastrar_produto_fotos.php', ['id' => $_SESSION['produto'], 'falta' => $falta, 'fotos' => $fotos]);
				endif;
			endif;
		}
		
		public function cadastro($dados){
			if($dados['token'] == $_SESSION['token']):
				$cadastro = new Fotos($this->db);
				$resposta = $cadastro->cadastro($dados);
				echo json_encode($resposta);
			endif;
		}
		
		public function excluir($dados){
			if($dados['token'] == $_SESSION['token']):
				$excluir = new Fotos($this->db);
				$resposta = $excluir->excluir($dados);
				echo json_encode($resposta);
			endif;
		}
		
		public function finalizar(){
			unset($_SESSION['produto']);
			$retorno['resposta'] = 'finalizou';
			echo json_encode($retorno);
		}
	}