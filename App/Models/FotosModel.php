<?php
	namespace App\Models;
    use App\Models\Model;
	
	class FotosModel extends Model
	{
		public function fotos($id){
			try {
				$stmt = $this->db->prepare("SELECT `id`, `foto` FROM `loja_fotos_produto` WHERE `id_produto` = :id");
				$stmt->bindValue(":id", $id, \PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll(\PDO::FETCH_ASSOC);
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function cadastro(){
			$produto = filter_input(INPUT_POST, 'produto', FILTER_SANITIZE_NUMBER_INT);
			
			$foto = $_FILES['foto'];
			$tmp = $foto['tmp_name'];
			$nome = $foto['name'];
			$renomear = md5(uniqid(rand(), true)).$nome;
			$novo_nome = $this->filtro($renomear);
			if ($this->foto($tmp, $nome, $novo_nome, '500', 'public/produtos/')) {
				try {
					$stmt = $this->db->prepare("INSERT INTO `loja_fotos_produto` (`id_produto`, `foto`) VALUES (:produto, :foto)");
					$stmt->bindValue(':produto', $produto, \PDO::PARAM_INT);
					$stmt->bindValue(':foto', $novo_nome, \PDO::PARAM_STR);
					if ($stmt->execute()) {
						$_SESSION['token'] = hash('sha512', rand(10, 1000));
						$retorno['resposta'] = 'cadastrou';
						$retorno['token'] = $_SESSION['token'];
						return $retorno;
					}
				} catch(\PDOException $e) {
					die($e->getMessage());
				}
			}
		}
		
		public function foto($tmp, $name, $nome, $larguraP, $pasta){
			$ext = end(explode('.', $name));
			if ($ext == 'jpg' || $ext == 'JPG' || $ext == 'jpeg' || $ext == 'JPEG') {
				$img = imagecreatefromjpeg($tmp);
			} elseif($ext == 'png') {
				$img = imagecreatefrompng($tmp);
			}
			list($larg, $alt) = getimagesize($tmp);
			$x = $larg;
			$y = $alt;
			$largura = ($x > $larguraP) ? $larguraP : $x;
			$altura = ($largura * $y) / $x;
			
			if ($altura > $larguraP) {
				$altura = $larguraP;
				$largura = ($altura * $x) / $y;
			}
			
			$nova = imagecreatetruecolor($largura, $altura);
			
			if ($ext == "png") {
				imagealphablending($nova, false);
				imagesavealpha($nova, true);
			}
			
			imagecopyresampled($nova, $img, 0,0,0,0, $largura, $altura, $x, $y);
			
			switch($ext) {
				case 'jpg':
				case 'jpeg':
					imagejpeg($nova, $pasta.$nome); break;
				case 'png':
					imagepng($nova, $pasta.$nome); break;
			}
			
			imagedestroy($img);
			imagedestroy($nova);
			return (file_exists($pasta.$nome)) ? true : false;
		}
		
		public function excluir(){
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
			$foto = filter_input(INPUT_POST, 'foto', FILTER_SANITIZE_STRING);
			
			try {
				$stmt = $this->db->prepare("DELETE FROM `loja_fotos_produto` WHERE `id` = :id");
				$stmt->bindValue(':id', $id, \PDO::PARAM_INT);
				if ($stmt->execute()) {
					unlink('public/produtos/'.$foto);
					$_SESSION['token'] = hash('sha512', rand(10, 1000));
					$retorno['resposta'] = 'excluiu';
					$retorno['token'] = $_SESSION['token'];
					return $retorno;
				}
			} catch(\PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function filtro($nome){
			$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
			$b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
			$nome = utf8_decode($nome);
			$nome = strtr($nome, utf8_decode($a), $b);
			$nome = str_replace(" ","_",$nome);
			$nome = strtolower($nome);
			return utf8_encode($nome);
		}
	}