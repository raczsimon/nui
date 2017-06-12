<?php
namespace Nui\Helpers;

use Nui\Environment\Controller;
use Nui\Helpers\Guider;
use Latte\Engine;

/**
 * A helper for module controllers
 */
class Middleware extends Controller
{
    /**
     * Render view
     * @param string View name
     * @return void
     */
    protected function render($view, $data = [])
    {
        $engine = new Engine;
        $engine->render(
            Guider::getViewFolderPath($this->reflect->_controller). '\\' . $view . '.latte',
            array_merge($data, ['reflect' => $this])
        );
    }
    
    /**
     * Call regular methods for controllers
     * @return void
     */
    protected function callRegular()
    {
        $this->callMethod('begin');
        $this->callMethod('action', $this->reflect->view);
        $this->callMethod('render', $this->reflect->view);
        $this->callMethod('end');
    }
        /**
         * A function for callRegular()
         * Calls a method if exists
         * @param string $name Method name
         * @param string $suffix Suffix
         * @return void
         */
        private function callMethod($name, $suffix = '')
        {
            $method = $name . ucfirst($suffix);
            if (method_exists($this, $method))
                $this->$method();
        }
}