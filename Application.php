<?php
/**
 * Default application container
 * @category Chco
 * @package  Application
 * @author   CHCO
 * @version  Release 1
 */
class Chco_Application
{
	/**
	 * Request object container
	 * @var Chco_Request
	 */
	private $request;
    
	/**
	 * Response object container
	 * @var Chco_Router
	 */
	private $router;
    
	/**
	 * Router object container
	 * @var Chco_Response
	 */
	private $response;
    
	/**
     *
     * @var Chco_View
     */
	private $view;
    
	/**
     *
     * @var Chco_Layout
     */
	private $layout;
	
	private static $config;
	
	/**

	 * @param string|array $config
	 */
	public function __construct($config) 
	{
        self::$config = Chco_Config::factory($config);
	}
	
	public function run()
	{
		// transformation de la requête HTTP en objet
		$this->request = new Chco_Request();
		// Routage de la requête pour déterminer un 
		// couple controller / action
		$this->router = new Chco_Router();
		$this->router->route($this->request);
		
		// Création de l'objet vue
		$this->layout = new Chco_Layout();
		$this->layout->setRequest($this->request);
		$this->view = new Chco_View( $this->request, $this->layout );
        
		// Création de la réponse HTTP en objet
		$this->response = new Chco_Response();
        
		// Dispatching ( instanciation du controller,
		// appel de l'action et fusion avec la vue )
		// 1. Instanciation du controller 
		$className = 'Controller_' . $this->request->getControllerName();
		$controller = new $className(
                        $this->request,
                        $this->response,
                        $this->view
                    );
		
		// 2. Appel de l'action
		$action = $this->request->getActionName() . 'Action';
		$controller->$action();
		
		// 3. Rendu de la vue
		$this->getResponse()
			 ->appendBody($this->view->render());
		// Envoi de la réponse au serveur HTTP
		// header() et print
		$this->getResponse()->send();
	}
    
	/**
	 * @return the $request
	 */
	public function getRequest()
	{
		return $this->request;
	}

	/**
	 * @return the $response
	 */
	public function getResponse() 
	{
		return $this->response;
	}
	
	public static function getConfig()
	{
		if ( !self::$config instanceof Chco_Config_Abstract ) {
			throw new RuntimeException(
			    'Config object not available at this time. '
			    . 'No Chco_Application instance loaded.'
			);
		}
		return self::$config;
	}
	

}