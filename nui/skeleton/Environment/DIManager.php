<?php
namespace Nui\Environment;

use Nui;

class DIManager extends Nui\Environment\Object
{
    /**
     * Return dependency injection container
     */
    public function getContainer {
        $loader = new Nette\DI\ContainerLoader($GLOBALS['main']->app['temp']);
        
        $class = $loader->load(function($compiler) {
            $compiler->loadConfig($GLOBALS['main']);
        });
        
        $container = new $class;
        return $container;
    }
}