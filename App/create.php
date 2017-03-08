<?php
	use App\Session;
	use App\Cookie;
	
	const __DIR_SESSION__ = __DIR__;
	
	// create a session
	$token = Session::create(['user' => 'William']);
	
	// create a cookie to remember session on client
	if($remember):
		Cookie::set('__dmz', $token);
	endif;