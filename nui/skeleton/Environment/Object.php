<?php
namespace Nui\Environment;

use Delight\Auth\Auth;

class Object
{
    /**
     * EntityManager
     */
    protected $entityManager;
    
    /**
     * Configuration
     */
    protected $config;
    
    /**
     * Language package
     */
    protected $lang;
    
    public function __construct()
    {
        if (isset($GLOBALS['settings']['em'])) {
            $this->entityManager = $GLOBALS['settings']['em'];
            $this->auth = $auth = new Auth($this->entityManager->getConnection()->getWrappedConnection());
        }
        if (isset($GLOBALS['settings']))
            $this->config = (object) $GLOBALS['settings'];
        if (isset($GLOBALS['language_manager'])) {
            $this->lang = $GLOBALS['language_manager'];
        }
    }
    
    public function flashMessage($message, $type = NULL)
    {
        $_SESSION['flash'][] = (object) [
            'message' => $message,
            'type' => $type
        ];
    }
    
    public function getFlashMessages()
    {
        return isset($_SESSION['flash']) ? $_SESSION['flash'] : (object) [];
    }
}