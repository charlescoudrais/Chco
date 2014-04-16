<?php
interface Chco_Action_Helper_Interface
{
    /**
	 * Pseudo constructor
	 * @param array $params
	 * @param Chco_Request $request
	 * @param Chco_Response $response
	 */
	public function direct(
		array $params, 
		Chco_Request $request, 
		Chco_Response $response
	);
}