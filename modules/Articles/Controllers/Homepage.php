<?php
namespace Modules\Articles\Controllers;

use Nui\Helpers\Middleware;

class Homepage extends Middleware
{
    public function init()
    {
        $this->auth->logout();
    }
}