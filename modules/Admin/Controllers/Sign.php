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
    /**
     * Try login user
     * If error -> error message
     * @param string $email Email
     * @param string $password Password
     * @return void
     */
    public function signIn($email, $password)
    {
        try {
            $this->auth->login($_POST['email'], $_POST['password']);
            $this->flashShortcut("loginSuccess", "success");
        }
        catch (InvalidEmailException $e) {
            $this->flashShortcut("wrongEmailAddress", "error");
        }
        catch (InvalidPasswordException $e) {
            $this->flashShortcut("wrongPassword", "error");
        }
        catch (EmailNotVerifiedException $e) {
            $this->flashShortcut("emailNotVerified", "error");
        }
        catch (TooManyRequestsException $e) {
            $this->flashShortcut("tooManyRequests", "error");
        }

        $this->redirect('admin');
    }
    
    /**
     * Shortcut for flash messages...
     */
    private function flashShortcut($message, $type)
    {
           $this->flashMessage(
                $this->lang->admin->$message 
                $this->config->main->classes[$type]
            );
    } 
}
