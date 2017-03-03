<?php
    namespace App;
	
    class Loader
    {
        public function register(){
            spl_autoload_register([
                $this,
                'load'
            ]);
        }
		
        public function load($class){
            $class = str_replace('\\', '/', $class);
            $folderFile = DIR.DS.$class.'.php';
            if(file_exists($folderFile)){
                require_once $folderFile;
            }
        }
    }