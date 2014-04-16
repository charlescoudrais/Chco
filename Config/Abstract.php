<?php
abstract class Chco_Config_Abstract implements Chco_Config_Interface
{
    /**
	 * @var array
	 */
	protected $_configs;
	
	/**
	 * class constructor
	 * @param array|string $config
	 */
	public function __construct($config)
	{
        $this->_load($config);

	}

	/** (non-PHPdoc)
	 * @see Chco_Config_Interface::toArray()
	 */
	public function toArray()
	{
        
		return $this->_configs;
	}
	
	/**
	 * Virtual properties
	 * In order to $config->prop to work
	 * @param property name $name
	 * @throws InvalidArgumentException
	 * @return Chco_Config_Array|array
	 */
	public function __get($name)
	{
		if (array_key_exists($name, $this->_configs)) {
			if (is_array($this->_configs[$name])) {
				return new Chco_Config_Array($this->_configs[$name]);
			} else {
				return $this->_configs[$name];
			}
		} else {
			throw new InvalidArgumentException(
				'Unknown config key ' . $name
			);
		}
		
	}
	
	/**
	 * Backend specific loading method
	 * @param array|string $config
	 */
	protected abstract function _load($config);
}