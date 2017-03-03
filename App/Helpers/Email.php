<?php
	namespace App\Helpers;
	require_once DIR.'\..\..\vendor\phpmailer\phpmailer\PHPMailerAutoload.php';
	
	class Email
	{
		protected $assunto;
		protected $mensagem;
		protected $emailempresa;
		protected $nomeempresa;
		protected $email;
		protected $nomedestino;
		
		public function __construct($assunto, $mensagem, $emailempresa, $nomeempresa, $email, $nomedestino){
			$this->assunto = $assunto;
			$this->mensagem = $mensagem;
			$this->emailempresa = $emailempresa;
			$this->nomeempresa = $nomeempresa;
			$this->email = $email;
			$this->nomedestino = $nomedestino;
		}
		
		public function enviar(){
			$mail = new PHPMailer();
			
			$mail->isSMTP();
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->Host = 'smtp.bol.com.br';
			$mail->Port = '587';
			$mail->Username = 'teste@bol.com.br';
			$mail->Password = 'SENHA';
			$mail->From = $this->emailempresa;
			$mail->FromName = $this->nomeempresa;
			$mail->isHTML(true);
			$mail->Subject = utf8_decode($this->assunto);
			$mail->Body = utf8_decode($this->mensagem);
			$mail->AddAddress($this->destino, utf8_decode($this->nomedestino));
			
			if (!$mail->Send()) {
				$retorno['resposta'] = 'erro';
			} else {
				$retorno['resposta'] = 'enviou';
			}
			return $retorno;
		}
	}