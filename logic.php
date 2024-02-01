<?php defined( '_JEXEC' ) or die;

// variables
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$menu = $app->getMenu();
$active = $app->getMenu()->getActive();
$params = $app->getParams();
$pageclass = $params->get('pageclass_sfx');
$tpath = $this->baseurl.'/templates/'.$this->template;

// generator tag
$this->setGenerator(null);

// template js
//$doc->addScript($tpath.'/js/logic.js');




$doc->addScript($tpath.'/js/popper.min.js');
$doc->addScript($tpath.'/js/tether.min.js');
$doc->addScript($tpath.'/js/jui/bootstrap.min.js');
//$doc->addScript($tpath.'/js/bootstrap.min.js');
//$doc->addScript($tpath.'/js/scripts.js');
//$doc->addScript($tpath.'/js/mega-menu.js');


$doc->addStyleSheet($tpath.'/css/bootstrap.min.css');
$doc->addStyleSheet($tpath.'/font-awesome/css/font-awesome.min.css');
// template css
$doc->addStyleSheet($tpath.'/css/style.css');
$doc->addStyleSheet($tpath.'/css/editor.css');
// $doc->addStyleSheet($tpath.'/css/template.css.php');
//$doc->addStyleSheet($tpath.'/css/mega-menu.css');
