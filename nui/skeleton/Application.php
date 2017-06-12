<?php
namespace Nui;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;

use Nui;

class Application extends Nui\Environment\Object
{
    private $routes;
    private $context;
    
    public function setRoutes($routes = [])
    {
        $this->routes = $routes;
    }
    
    private function createInstance()
    {   
        $this->context = new RequestContext('/');
        $this->context->fromRequest(Request::createFromGlobals());
        
        // Match
        $matcher = new UrlMatcher($this->routes, $this->context);
        $parameters = $matcher->match($this->getCurrentURI());
        
        return $parameters;
    }
    
    public function buildLink($route = '', $bind = [])
    {
        $generator = new UrlGenerator($GLOBALS['routes'], new RequestContext());
        
        $url = $generator->generate($route, $bind);
        return $url;
    }
    
    public function startSession()
    {
        $instance = $this->createInstance();
        
        $controller = str_replace(':', '\\', $instance['_controller']);
        $controller = new $controller;
        
        $controller->setReflect((object) $instance);
        $controller->addReflect('routes', $this->routes);
        $controller->addReflect('context', $this->context);
            
        $controller->init();
    }
    
    public function getCurrentURI()
    {
        return '/' . str_replace(
            str_replace(basename($_SERVER["SCRIPT_FILENAME"]), '', $_SERVER['PHP_SELF']),
            '',
            $_SERVER['REQUEST_URI']);
    }
}