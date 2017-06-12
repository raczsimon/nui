<?php
namespace Nui\Config;

use Nui;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Database extends Nui\Environment\Object implements Nui\Database\IHandler
{
    public function handle()
    {
        $config = Setup::createAnnotationMetadataConfiguration(
            array(__DIR__ . '/' . $this->config->main->database['entities']),
            $this->config->main->app['devmode']
        );

        $connectionOptions = array(
            'driver'   => $this->config->main->database['driver'],
            'host'     => $this->config->main->database['host'],
            'dbname'   => $this->config->main->database['dbname'],
            'user'     => $this->config->main->database['username'],
            'password' => $this->config->main->database['password']
        );

        return EntityManager::create($connectionOptions, $config);
    }
}