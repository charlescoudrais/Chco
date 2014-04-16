<?php
/**
 * Head title view helper
 * Sets and outputs HTML title tag within view
 * @category Chco
 * @package  View
 * @subpackage Helper
 * @author   CHCO
 * @version  Release 1
 */
class Chco_View_Helper_Title implements Chco_View_Helper_Interface
{
    /**
	 * @var string
	 */
	private static $titleText;
    
    /**
     *
     * @var string
     */
    private $title;
    
    /**
	 * @see Chco_View_Helper_Interface::direct()
	 */
    public function direct($params, $request)
    {
        self::$titleText = isset($params[0]) ? $params[0] : 'CHCO TITLE';
        $this->title     = '<title>' . self::$titleText . '</title>' . PHP_EOL;
        
        return $this->title;
    }
}