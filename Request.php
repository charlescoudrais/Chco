<?php
/**
 * Default application container
 * @category Chco
 * @package  Request
 * @author   CHCO
 * @version  Release 1
 */
class Chco_Request
{
    /**
	 * Request URI
	 * @var string
	 */
	private $uri;
	/**
	 * HTTP method
	 * @var string
	 */
	private $method;
	/**
	 * GPCS data
	 * @var array
	 */
	private $params = array();
	/**
	 * HTTP Headers
	 * @var array
	 */
	private $headers = array();
	
	/**
	 * Name of controller to be instanciated
	 * @var string
	 */
	private $controllerName;
	
	/**
	 * Name of action (method) to be called within controller
	 * @var string
	 */
	private $actionName;
    
    /**
	 * Builds request object from http request
	 */
    public function __construct() {
        $this->uri     = $_SERVER['REQUEST_URI'];
        $this->method  = $_SERVER['REQUEST_METHOD'];
        $this->params  = $_REQUEST;
        $this->headers = (function_exists('apache_request_header'))
                            ? apache_request_header()
                            : False;
    }
    
    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParams($paramName)
    {
        if (!isset($this->params[$paramName])) {
            return FALSE;
        }
        return $this->params[$paramName];
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public function setControllerName($controllerName)
    {
        $this->controllerName = ucfirst($controllerName);
        return $this;
    }

    public function setActionName($actionName)
    {
        $this->actionName = strtolower($actionName);
        return $this;
    }


}