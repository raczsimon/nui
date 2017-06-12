<?php
namespace Nui\Environment;

use Nui;

class Controller extends Nui\Environment\Object
{
    protected $reflect;
    
    public function setReflect($reflect) 
    {
        $this->reflect = $reflect;
    }
    
    public function addReflect($key, $value)
    {
        $this->reflect->$key = $value;
    }
    
    protected function isView($view) 
    {
        return $this->reflect->view == $view;
    }
    
    protected function changeView($view)
    {
        $this->reflect->view = $view;
    }
    
    protected function redirect($route, $bind = [])
    {
        $app = new Nui\Application;
        $link = $app->buildLink($route, $bind);
        $link = $_SERVER['HTTP_ORIGIN'] . str_replace($app->getCurrentURI(), '', $_SERVER['REQUEST_URI']) . $link;
        
        header('Location: ' . $link);
        die();
    }
}