<?php
namespace Modules\Error\Controllers;

use Nui\Helpers\Middleware;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Bootstrap extends Middleware {
    
    /**
     * Sort different types of errors into various controllers
     * @param Exception $e Exception
     * @return void
     */
    public function init($e) {
        if ($e instanceof ResourceNotFoundException) {
            $controller = new E404();
            
            $controller->setReflect((object) [
                '_controller' => 'Modules:Error:Controllers:E404',
                'view' => '404',
                'exception' => $e
            ]);
            
            $controller->init();
        } else {
            echo $e;
            var_dump($e);
        }
    }
}