<?php
/**
 * CurrentPage view helper
 * Checks wether a link in menu matches 
 * with current page (controller & action)
 * then output a specific CSS class
 * @category Chco
 * @package  View
 * @subpackage Helper
 * @author   CHCO
 * @version  Release 1
 */
class Chco_View_Helper_CurrentPage
	implements Chco_View_Helper_Interface
{
	/**
	 * @see Chco_View_Helper_Interface::direct()
	 */
	public function direct($params, $request)
	{
		$controller = $params[0];
		$action = $params[1];
		if ($request->getControllerName() == $controller &&
			$request->getActionName() == $action . 'Action' ) {
			return 'class="current_page_item" ';
		} else {
			return '';
		}
	}
}