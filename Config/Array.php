<?php
class Chco_Config_Array extends Chco_Config_Abstract
{
    /**
	 * @var array
	 */
//	protected $_configs;
    
    /**
	 * @see Chco_Config_Abstract::_load()
	 */
	protected function _load($config) 
	{
		$this->_configs = $config;
		return $this->_configs;
	}
}