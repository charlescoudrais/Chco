<?php
abstract class Chco_Controller_Abstract implements Chco_Controller_Interface
{
    /**
	 * @var Chco_Request
	 */
	protected $_request;
	/**
	 * @var Chco_Response
	 */
	protected $_response;
	/**
	 * @var Chco_View
	 */
	protected $_view;
	
	/**
	 * Class constructor
	 * @param Chco_Request $request
	 * @param Chco_Response $response
	 * @param Chco_View $view
	 */
	public function __construct(
		Chco_Request $request, 
		Chco_Response $response, 
		Chco_View $view
	)
	{
		$this->_request  = $request;
		$this->_response = $response;
		$this->_view     = $view;
		$this->_init();
	}
    
    /**
	 * Class pseudo constructor
	 * To be called within concrete controllers
	 */
	protected function _init()
	{
	}
    
	/**
	 * @return the $_request
	 */
	public function getRequest()
	{
		return $this->_request;
	}

	/**
	 * @return the $_response
	 */
	public function getResponse()
	{
		return $this->_response;
	}

	/**
	 * @return the $_view
	 */
	public function getView()
	{
		return $this->_view;
	}

	/**
	 * @param field_type $_request
	 */
	public function setRequest($_request)
	{
		$this->_request = $_request;
        return $this;
	}

	/**
	 * @param field_type $_response
	 */
	public function setResponse($_response)
	{
		$this->_response = $_response;
        return $this;
	}

	/**
	 * @param field_type $_view
	 */
	public function setView($_view)
	{
		$this->_view = $_view;
        return $this;
	}

	/**
	 * Virtual methods for action helper calls
	 * @param string $name
	 * @param array $args
	 */
	public function __call($name, $args)
	{
		$className = 'Chco_Action_Helper_' . ucfirst($name);
		$helper = new $className;
        return $helper->direct($args, $this->_request, $this->_response);
	}
    
}