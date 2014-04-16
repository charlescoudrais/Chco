<?php
/**
 * Config object with INI backend 
 * @category Chco
 * @package  Config
 * @author   JB
 * @version  Release 1
 */
class Chco_Config_Ini extends Chco_Config_Abstract
{
    /**
	 * @var array
	 */
//	protected $_configs;
    
//    public function __construct($config) {
//        parent::__construct($config);
//        $this->_load($config);
//    }
    /**
     * (non-PHPdoc)
	 * @see Chco_Config_Abstract::_load()
	 */
	protected function _load($configFile) 
	{
		$configs = parse_ini_file($configFile);
		$this->_configs = $this->_parse($configs);
		return $this->_configs;
	}
	
	/**
	 * Parses ini file then sends each line
	 * to _parseLine() for "string to nested array"
	 * translation 
	 * @param array $config
	 * @return arrray
	 */
	private function _parse(array $config)
	{
		foreach ($config as $key => $value) {
			$config = $this->_parseLine($config, $key, $value);
		}
		return $config;
	}
	
	/**
	 * Recursive iterator for ini file keys
	 * transforms '.' separator into array nested levels
	 * @param array $config
	 * @param string $key
	 * @param string $value
	 * @return array
	 */
	private function _parseLine($config, $key, $value)
    {
        // Si il y a un point dans le nom de la clé
        if (strpos($key, '.') !== FALSE) {
        	// on découpe la clé
            $keyParts = explode('.', $key, 2);
            
            // Si la première partie n'est pas déjà une clé de $config
            // on la créée
            if (!isset($config[$keyParts[0]])) {
	               $config[$keyParts[0]] = array();
            }
            // Puis on teste de manière récursive car il peut y avoir encore
            // un point dans la clé (sous-niveau)
			$config[$keyParts[0]] = $this->_parseLine(
				$config[$keyParts[0]], 
				$keyParts[1], 
				$value
			);
            // On détruit la clé initiale (celle qui contient le ou les points)
            unset($config[$key]);
		// Si il n'y a pas de point, on affecte simplement
        } else {
            $config[$key] = $value;
        }
        // on retourne la config modifiée
        return $config;
        
    }
    
}