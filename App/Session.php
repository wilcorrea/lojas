<?php
	namespace App;
	use Exception;
	
	abstract class Session
	{
		private static $token;
		private static $data;
		const LIFE_TIME = 86400;
		
		public static function create($data){
			self::$token = uniqid();
			static::$data = $data;
			
			if(static::write()):
				return self::$token;
			endif;
			throw new Exception("Can`t create a session in `" . self::$token . "`");
		}
		
		public static function start($token){
			if(!file_exists(static::filename($token))):
				throw new Exception("The session `{$token}` no longer exists");
			endif;
			if(!static::check($token)):
				throw new Exception("The session `{$token}` is expired");
			endif;
			self::$token = $token;
			static::$data = static::read();
			
			return static::$data;
		}
		
		public static function get($index, $default = null){
			return isset(static::$data[$index]) ? static::$data[$index] : $default;
		}
		
		public static function set($index, $value){
			static::$data[$index] = $value;
			return static::write();
		}
		
		public static function destroy($token = null){
			if(!$token):
				$token = self::$token;
			endif;
			return unlink(self::filename($token));
		}
		
		public static function check($token, $now = null){
			$check = false;
			$filename = static::filename($token);
			if(file_exists($filename)):
				$check = true;
				$now = ($now ? $now : time());
				$diff = round($now - filemtime(static::filename($token)));
				if($diff > static::LIFE_TIME):
					$check = false;
					static::destroy($token);
				endif;
				if($check):
					touch($filename);
				endif;
			endif;
			return $check;
		}
		
		private static function write(){
			return file_put_contents(self::filename(self::$token), json_encode(static::$data));
		}
		
		private static function read(){
			return (array)json_decode(file_get_contents(self::filename(self::$token)));
		}
		
		private static function filename($token){
			if(defined('__DIR_SESSION__')):
				return __DIR_SESSION__ . '/' . $token;
			endif;
			throw new Exception("The constant `__DIR_SESSION__` is not defined");
		}
	}