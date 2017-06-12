<?php
namespace Modules\Admin\Controllers;

use Nette;
use Nui\Entity;
use Nui\Helpers\Middleware;
use Nui\Helpers\Security;

use Modules\Admin\Components\SignForm;

class General extends Middleware
{
    public $em;
    
    /**
     * Sandbox for Administration
     */
    public function init()
    { 
        if (!$this->auth->isLoggedIn()) {
            $this->login();
        } else {
            $this->dashboard();
        }
    }
    
    /**
     * Login view
     */
    public function login()
    {
        $this->changeView('login');
        
        $data = [
            'signForm' => (new SignForm)->createForm()  
        ];
        
        $this->render('sign/in', $data);
    }
    
    /**
     * Dashboard view
     */
    public function dashboard()
    {
        $this->changeView('dashboard');
    }
}