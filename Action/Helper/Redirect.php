<?php
/**
 * Redirect helper
 * Injects redirection HTTP headers into Response
 * @category Chco
 * @package  Action
 * @subpackage Helper
 * @author   CHCO
 * @version  Release 1
 */
class Chco_Action_Helper_Redirect implements Chco_Action_Helper_Interface
{
	/**
     * 
	 * @see Chco_Action_Helper_Interface::direct()
	 */
	public function direct(
		array $params, 
		Chco_Request $request, 
		Chco_Response $response
	)
	{
		$response->addHeader('HTTP/1.1 301 Moved Permanently');
		$response->addHeader('Location: ' . $params[0]);
	}
}