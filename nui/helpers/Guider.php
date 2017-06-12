<?php
namespace Nui\Helpers;

use Nui;

/**
 * Guider for Nui type paths
 */
class Guider extends Nui\Environment\Object
{
    /**
     * Replace : by \\
     * @param string $route Route you want to compile
     * @return string Compiled route
     */
    public static function toPath($route)
    {
        return str_replace(':', '\\', $route);
    }
    
    /**
     * Gets folder path for Views based on Controller
     * @param string $path Path to Controller
     * @return void
     */
    public static function getViewFolderPath($path)
    {
        $guide = explode('\\', self::toPath($path));
        $guide = $guide[0] . '\\' . $guide[1] . '\\Views';
        return $guide;
    }
}