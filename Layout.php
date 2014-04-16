<?php
/**
 * Default application container
 * @category Chco
 * @package  Layout
 * @author   CHCO
 * @version  Release 1
 */
class Chco_Layout
{
    /**
	 * @var string
	 */
	private $content;
	/**
	 * @var Chco_Request
	 */
	private $request;
	/**
	 * @var Chco_View
	 */
	private $view;
	/**
	 * @var string
	 */
	private $file = 'layout';
    
    
    public function getContent()
    {
        return $this->content;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getFile()
    {
        return $this->file;
    }
    
    public function getView()
    {
        return $this->view;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function setRequest(Chco_Request $request)
    {
        $this->request = $request;
        return $this;
    }

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }
    
    public function setView()
    {
        $this->view = new Chco_View($this->request, $this);
        return $this;
    }

    /**
	 * Renders Layout file 
	 * @param string $content
	 */
	public function render($content)
	{
		$this->setContent($content);
		require_once 'View/layouts/' . $this->file . '.phtml';
	}
    
    /**
	 * Magic shortcut for view helpers calls
	 * @param  string $name helper's name 
	 * @param array $args helper's arguments  
	 */
	public function __call($name, $args)
	{
		$className = 'Chco_View_Helper_' . ucfirst($name);
		$helper = new $className;
		return $helper->direct($args, $this->request);
	}
}