<?php
	namespace App\Controllers;
	use App\Controllers\Controller;
	use App\Models\ComboModel as Combo;
	
	class ComboController extends Controller
	{
		public function categoria($categoria){
			$subcategorias = new Combo($this->db);
			$dados = $subcategorias->subcategoria($categoria);
			echo json_encode($dados);
		}
		
		public function estado($estado){
			$cidades = new Combo($this->db);
			$dados = $cidades->cidade($estado);
			echo json_encode($dados);
		}
	}