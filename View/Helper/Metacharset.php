<?php
class Chco_View_Helper_Metacharset implements Chco_View_Helper_Interface
{
    /**
	 * @var string
	 */
	private static $version;
    
    /**
     *
     * @var string
     */
    private $charset;
    
    /**
	 * @see Chco_View_Helper_Interface::direct()
	 */
    public function direct($params, $request)
    {
        self::$version = isset($params[0]) ? $params[0] : 'iso-8859-1';
        
        $this->charset = '<meta charset="' . self::$version . '" />' . PHP_EOL;
        return $this->charset;
    }
}