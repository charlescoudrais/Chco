<?php
/**
 * view helper interface
 * @category Chco
 * @package  View
 * @subpackage Helper
 * @author   CHCO
 * @version  Release 1
 */
interface Chco_View_Helper_Interface
{
	/**
	 * Enter description here ...
	 * @param array $params
	 * @param Chco_Request $request
	 */
	public function direct($params, $request);
}