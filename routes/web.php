<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();
$routes->add('home', new Route('/', array('controller' => 'HomeController', 'method'=>'index')));
$routes->add('tree-entry', new Route('/tree-entry', array('controller' => 'TreeEntryController', 'method'=>'index')));
$routes->add('root-tree-entry', new Route('/root-tree-entry', array('controller' => 'TreeEntryController', 'method'=>'getRootEntry')));
$routes->add('tree-entry-children', new Route('/tree-entry/children/{id}', array('controller' => 'TreeEntryController', 'method'=>'getChildren')));

return $routes;