<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initSetupBaseUrl() {
	    $this->bootstrap('frontcontroller');
	    $controller = Zend_Controller_Front::getInstance();
	    $controller->setBaseUrl('/zend_project/public'); 
	}

	protected function _initPlaceholders()
	{
		$this->bootstrap('View');
		$view = $this->getResource('View');
		$view->doctype('HTML5');
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
		$view->headScript()->appendFile($view->baseUrl().'/js/my_functions.js');
	}
}




