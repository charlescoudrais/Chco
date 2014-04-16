<?php 

/**
 * Default application autoloader
 * @category Chco
 * @package  Autoloader
 * @author   CHCO
 * @version  Release 1
 */

class Chco_Autoloader
{
	/**
	 * Basic autoload method
	 * @param string $class
	 * @throws RuntimeException if class definition does not exists
	 */
	public static function autoload($class)
	{
	    if (strstr($class, 'PHPUnit' )) {
	        return;
	    }
		$className = str_replace(
                        '_', 
                        DIRECTORY_SEPARATOR,
                        $class
                    ) 
                    . '.php';
			
		if (!$absoluteClassName = stream_resolve_include_path($className)) {
			$message = $className . ' introuvable.' . PHP_EOL .
					   'Valeur de l\'include_path : ' . 
					   get_include_path() . PHP_EOL;
					   
			throw new RuntimeException($message);
		}
		require_once $absoluteClassName;
	}
	
	/**
	 * Statically registers autoload callback
	 */
	public static function startAutoload()
	{
		spl_autoload_register(
			array('self', 'autoload')
		);
	}

}