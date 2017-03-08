<?php
	use App\Session;
	use App\Cookie;
	
	// constant to dir of file of sessions
	const __DIR_SESSION__ = __DIR__;
	
	if(Cookie::get('__dmz')):
		Session::start(Cookie::get('__dmz'));
	endif;
	
	echo Session::get('user'); // William