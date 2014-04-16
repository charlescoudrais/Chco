<?php
/**
 * Doctype view helper
 * Sets and outputs HTML doctype within view
 * @category Chco
 * @package  View
 * @subpackage Helper
 * @author   CHCO
 * @version  Release 1
 */
class Chco_View_Helper_Doctype implements Chco_View_Helper_Interface
{
	/**
	 * @var string
	 */
	private static $version;
    
    /**
     *
     * @var string
     */
    private $doctype;
	
	/**
	 * @see Chco_View_Helper_Interface::direct()
	 */
	public function direct($params, $request)
	{
		self::$version = isset($params[0]) ? $params[0] : 'transitional';
		switch(self::$version) {
            case 'strict' :
				$this->doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 '
                                . 'Strict//EN" '
                                . '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict'
                                . '.dtd">'
                                . PHP_EOL;
				break;
			case 'html5' :
				$this->doctype = '<!DOCTYPE html>' . PHP_EOL;
				break;
			case 'transitional' :
			default :
				$this->doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 '
                                . 'Transitional//EN" '
                                . '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-'
                                . 'transitional.dtd">'
                                . PHP_EOL;
				break;
		}
        return $this->doctype;
	}
	
	public static function getVersion()
	{
		return self::$version;
	}
}
