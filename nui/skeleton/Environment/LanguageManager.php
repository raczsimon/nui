<?php
namespace Nui\Environment;

use Nette\Neon\Decoder;

class LanguageManager
{
    private $registered;
    
    public function __construct()
    {
        $this->registered = $GLOBALS['settings']['lang']; 
        $this->decode();
    }
    
    private function decode()
    {
        $test = new Decoder;
        
        foreach ($this->registered as $key => $langFile) {
            $this->$key = (object) $test->decode(file_get_contents($langFile . '\\Lang\\' . $GLOBALS['settings']['main']->app['lang'] . '.neon'));
        }
    }
}