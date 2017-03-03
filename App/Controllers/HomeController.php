<?php
	namespace App\Controllers;
	use App\Controllers\Controller;
	use App\Helpers\Paginacao;
	
	class HomeController extends Controller
	{
		public function acesso_loja(){
			if (isset($_SESSION['acesso_loja'])) {				
				$this->render->setHf('loja/header.php', 'loja/footer.php');
				$this->render->load('loja/home.php', []);
			} else {
				$this->router->redirectTo('login_loja');
			}
		}
	}