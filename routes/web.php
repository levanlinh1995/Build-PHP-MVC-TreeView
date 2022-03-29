<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();
$routes->add('home', new Route('/', array('controller' => 'HomeController', 'method'=>'index')));
$routes->add('tree-entry', new Route('/tree-entry', array('controller' => 'TreeEntryController', 'method'=>'index')));

return $routes;