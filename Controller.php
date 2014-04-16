<?php
/**
 * 
 * @author   CHCO
 * @version  Release 1
 */
class Chco_Controller extends Chco_Controller_Abstract
{
    /**
     * return the controller's view object
     * @protected Chco_View
     */
    protected $_view;
    
    public function _init()
    {
        $this->_view = $this->getView();
    }
    
    public function indexAction()
    {
        
    }
}