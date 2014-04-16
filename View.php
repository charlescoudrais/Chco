<?php
/**
 * View object
 * @category Chco
 * @package  View
 * @author   CHCO
 * @version Release 1
 */
class Chco_View
{
    /**
     *
     * @var Chco_Request 
     */
    private $request;
	/**
     *
     * @var Chco_Layout 
     */
    private $layout;

    /**
	 * Class constructor
	 * @param Chco_Request $request
	 * @param Chco_Layout $layout
	 */
	public function __construct(Chco_Request $request, Chco_Layout $layout = null)
	{ 
		$this->request = $request;
		$this->layout  = $layout;
	}
    
    public function getRequest()
    {
        return $this->request;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function setRequest(Chco_Request $request)
    {
        $this->request = $request;
        return $this;
    }

    public function setLayout(Chco_Layout $layout)
    {
        $this->layout = $layout;
        return $this;
    }
    
    /**
	 * Renders view file (.phtml), inserts it into layout if needed
	 * @return string $finalContent
	 */
	public function render()
	{
		$viewFile = 'View/scripts/' . 
					$this->request->getControllerName()
                    . '/'
                    . $this->request->getActionName()
                    . '.phtml';
					
		ob_start();			
        if ($this->layout instanceof Chco_Layout) {
            ob_start();
                require_once $viewFile;
            $content = ob_get_contents();
            ob_end_clean();
            $this->layout->render($content);
        } else {
            require_once $viewFile;
        }
		$finalContent = ob_get_contents();
		ob_end_clean();
		return $finalContent;
	}
    
    /**
	 * Magic shortcut for view helpers usage
	 * @param string $name Helper's name
	 * @param array $args Helpers arguments
	 */
	public function __call($name, $args)
	{
        $className = 'Chco_View_Helper_' . ucfirst($name);
		$helper = new $className;
		return $helper->direct($args, $this->request);
	}
}