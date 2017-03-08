<?php
	namespace App;
	
	abstract class Cookie
	{
		public static function set($name, $value, $expire = null, $path = null, $domain = null, $secure = null, $httpOnly = null){
			$httpHost = filter_input(INPUT_SERVER, 'HTTP_HOST');
			
			$expire = $expire ? $expire : (time() + (60 * 60 * 24 * 365));
			$path = $path ? $path : '/';
			$domain = $domain ? $domain : (($httpHost !== 'localhost') ? $httpHost : false);
			
			return setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
		}
		
		public static function get($name, $default){
			return isset($_COOKIE[$name]) ? $_COOKIE[$name] : $default;
		}
		
		public function destroy($name, $expire = null, $path = null, $domain = null, $secure = null, $httpOnly = null){
			if(isset($_COOKIE[$name])):
				unset($_COOKIE[$name]);
				return static::set($name, null, $expire, $path, $domain, $secure, $httpOnly);
			endif;
			return false;
		}
	}