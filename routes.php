<?php
$controllers = array(
  'pages' => ['home', 'error'],
  'sports' => ['update','index','edit','insert','delete'],
  'users' => ['index','login']
); 
if (!array_key_exists($controller, $controllers)|| !in_array($action, $controllers[$controller])) {
  
  $controller = 'pages';
  $action = 'error';
}



include_once('controllers/' . $controller . 'Controller.php');

$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();
