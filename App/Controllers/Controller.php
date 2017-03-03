<?php
	namespace App\Controllers;
	
	abstract class Controller
	{
		protected $container;
		
		public function __construct(\DRouter\Container $container){
			$this->container = $container;
		}
		
		public function __get($key){
			if($this->container->{$key}){
				return $this->container->{$key};
			}
		}
	}