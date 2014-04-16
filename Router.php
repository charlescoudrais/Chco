<?php
/**
 * Routing object
 * @category Chco
 * @package  Router
 * @author   Chco
 * @version Release 1
 */
class Chco_Router
{
	/**
	 * Determines controller name and action name from a Request object
	 * @param Chco_Request $request
	 */
	public function route(Chco_Request $request)
	{
		$uri      = explode('?', trim($request->getUri(), DIRECTORY_SEPARATOR));
		$baseUri  = $uri[0];
		$uriParts = explode(DIRECTORY_SEPARATOR, $baseUri);
		
		$controllerName = empty($uriParts[0]) 
                            ? 'Index'
                            : $uriParts[0];
		$actionName = empty($uriParts[1])
                        ? 'index'
                        : $uriParts[1];
		
		// 404 ?
		$controllerFile = stream_resolve_include_path(
                            'Controller'
                            . DIRECTORY_SEPARATOR
                            . ucfirst($controllerName) . '.php'
                        );
        
		if (!file_exists($controllerFile)) {
            $controllerName = 'Error';
            $actionName = 'error';
        }
        
    	if (!method_exists(
                'Controller_' . ucfirst($controllerName), 
                $actionName . 'Action'
        	)
        ) {
            $controllerName = 'Error';
            $actionName = 'error';
        }
        
		$request->setControllerName($controllerName);
		$request->setActionName($actionName);
	}
}