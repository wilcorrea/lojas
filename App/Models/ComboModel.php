<?php
    namespace App\Models;
	use App\Models\Model;
	
    class ComboModel extends Model
    {
		public function subcategoria(){
			$categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT);
			
			try {
				$subcategorias = $this->db->prepare("SELECT `admin_subcategorias`.`id`, `admin_subcategorias`.`subcategoria` FROM `admin_categorias` INNER JOIN `admin_subcategorias` ON `admin_subcategorias`.`id_categoria` = `admin_categorias`.`id` WHERE `admin_categorias`.`id` = :categoria");
				$subcategorias->bindValue(":categoria", $categoria, \PDO::PARAM_INT);
				$subcategorias->execute();
				return $subcategorias->fetchAll(\PDO::FETCH_ASSOC);
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function cidade(){
			$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_NUMBER_INT);
			
			try {					
				$cidades = $this->db->prepare("SELECT `admin_cidades`.`id`, `admin_cidades`.`nome` FROM `admin_estados` INNER JOIN `admin_cidades` ON `admin_cidades`.`estado` = `admin_estados`.`id` WHERE `admin_estados`.`id` = :estado");
				$cidades->bindValue(":estado", $estado, \PDO::PARAM_INT);
				$cidades->execute();
				return $cidades->fetchAll(\PDO::FETCH_ASSOC);
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
	}