<?php
namespace Modules\Admin\Components;

use Nui;
use Modules\Admin\Controllers;
use Nette\Forms\Form;

class SignForm extends Nui\Environment\Object
{
    public function createForm()
    {
        $form = new Form;
        
        $form->addText('email', 'Email:')
             ->setRequired()
             ->addRule(Form::EMAIL);
        
        $form->addPassword('password', 'Password:')
             ->setRequired();
        
        $form->addSubmit('login', 'Sign in');
        
        $form->onSuccess[] = [(new Controllers\Sign), 'signIn'];
        $form->fireEvents();
        
        return $form;
    }
}