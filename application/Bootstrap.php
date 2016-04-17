<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/*protected function _initSetupBaseUrl() {
	    $this->bootstrap('frontcontroller');
	    $controller = Zend_Controller_Front::getInstance();
	    $controller->setBaseUrl('/new_zend/public'); 
	}*/
	 protected function _initRequest()
    {
        $this->bootstrap('FrontController');

        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();

        $front->setRequest($request);
    }
    protected function _initSession(){
		Zend_Session::start();
		$session = new Zend_Session_Namespace( 'Zend_Auth' );
		$session->setExpirationSeconds( 1800 );
	}
/*     protected function _initPlugins()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('My_');
 
        $objFront = Zend_Controller_Front::getInstance();
        $objFront->registerPlugin(new My_Controller_Plugin_ACL(), 1);
        return $objFront;
    }*/
	protected function _initPlaceholders()
	{
            $this->bootstrap('view');
            $view = $this->getResource('view');
            $view->doctype('XHTML1_STRICT');
            		//echo $view->baseUrl();
		//Meta
		$view->headMeta()->appendName('keywords', 'framework, PHP')->appendHttpEquiv('Content-Type','text/html;charset=utf-8');
			// Set the initial title and separator:
		$view->headTitle('Fourms')->setSeparator(' | ');
		$view->headScript()->prependFile($view->baseUrl().'/js/jquery-1.11.2.js');
			// Set the initial stylesheet:
		$view->headLink()->prependStylesheet($view->baseUrl()."/css/bootstrap.min.css");
		$view->headLink()->prependStylesheet($view->baseUrl().'/css/style.css');
			// Set the initial JS to load:
		
		$view->headScript()->appendFile($view->baseUrl().'/js/bootstrap.min.js');
	}

}

