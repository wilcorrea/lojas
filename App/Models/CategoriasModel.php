<?php
	namespace App\Models;
	use App\Models\Model;
	
	class CategoriasModel extends Model
	{
		public function categorias(){
			try {
				$stmt = $this->db->prepare("SELECT * FROM `admin_categorias` ORDER BY `categoria` ASC");
				$stmt->execute();
				return $stmt->fetchAll(\PDO::FETCH_ASSOC);
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function estados(){
			try {
				$stmt = $this->db->prepare("SELECT * FROM `admin_estados` ORDER BY `nome` ASC");
				$stmt->execute();
				return $stmt->fetchAll(\PDO::FETCH_ASSOC);
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
	}