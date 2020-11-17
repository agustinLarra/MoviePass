<?php namespace Config;
	
    class Autoload {
        
        public static function Start() {
            spl_autoload_register(function($className)
			{
                $classPath = ucwords(str_replace("\\", "/", ROOT.$className).".php");
                list($aux,$otro) = explode('\\',$className);

                if($aux != 'Facebook'){ 
                    include_once($classPath);
                }
                
            });
            
        }
    }
?>