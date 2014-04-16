<?php
/**
 * Config factory wrapper
 * @category Chco
 * @package  Config
 * @author   CHCO
 * @version Release 1
 */
class Chco_Config
{
    /**
	 * Factory patterne, 
	 * builds staticaly Config objects
	 * for given backend param
	 * @param string|array $param
	 * @throws InvalidArgumentException
	 * @return Ambigous <Chco_Config_Array, Chco_Config_Ini, Chco_Config_Xml>
	 */
	public static function factory($param)
	{
        
		if (is_array($param)) {
            
			$obj = new Chco_Config_Array($param);
            
		} else if (is_string($param)) {
            
			$fileExt = substr($param, strrpos($param, '.')+1);
            
			switch(strtolower($fileExt)) {
				case 'xml' :
					$obj = new Chco_Config_Xml($param);
					break;
				case 'ini' :
					$obj = new Chco_Config_Ini($param);break;
				default :
					throw new InvalidArgumentException(
						'Unknown config file format .' . $fileExt
					);
			}
            
		} else {
            
			throw new InvalidArgumentException(
				__METHOD__ 
                    . ' expects '
                    . 'parameter one to be a string or an array '
                    . gettype($param) 
                    . ' given'
			);
            
		}
		
		return $obj;
	}
}