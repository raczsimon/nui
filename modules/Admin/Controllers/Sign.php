<?php
namespace Modules\Admin\Controllers;

use Nui;
use Nui\Helpers\Middleware;
use Delight;
use Delight\Auth\InvalidEmailException;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\EmailNotVerifiedException;
use Delight\Auth\TooManyRequestsException;

class Sign extends Middleware
{
    public function signIn($email, $password)
    {
        try {
            $this->auth->login($_POST['email'], $_POST['password']);
            
            $this->flashMessage(
                $this->lang->admin->loginSuccess, 
                $this->config->main->classes['success']
            );
        }
        catch (InvalidEmailException $e) {
            $this->flashMessage(
                $this->lang->admin->wrongEmailAddress, 
                $this->config->main->classes['error']
            );
        }
        catch (InvalidPasswordException $e) {
            $this->flashMessage(
                $this->lang->admin->wrongPassword, 
                $this->config->main->classes['error']
            );
        }
        catch (EmailNotVerifiedException $e) {
            $this->flashMessage(
                $this->lang->admin->emailNotVerified, 
                $this->config->main->classes['error']
            );
        }
        catch (TooManyRequestsException $e) {
            $this->flashMessage(
                $this->lang->admin->tooManyRequests, 
                $this->config->main->classes['error']
            );
        }
        
        $this->redirect('admin');
    }
}