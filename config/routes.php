<?php
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('homepage', 
        new Route(
            '/', 
            array(
                '_controller' => 'Modules:Articles:Controllers:Homepage', 
                'view' => 'default'
            )
        )
);

$routes->add('admin',
     new Route(
        '/admin',
        array('_controller' => 'Modules:Admin:Controllers:General')
    )
);

return $routes;