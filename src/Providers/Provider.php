<?php
namespace MayCad\SMS\Providers;

use GuzzleHttp\Client;

/**
 * 
 */
abstract class Provider implements IProvider
{
    private $_config = array();

    public function __construct(array $config = array())
    {
        $this->setConfig($config);
    }

    public function setConfig(array $config = array())
    {
    	$this->_config = $config;

        return $this;
    }

    public function getConfig()
    {
        return $this->_config;
    }

    public function get(string $key)
    {
        return $this->_config[$key];
    }

    public function getClient()
    {
        return new Client([
            'base_uri' => $this->get('base_uri')
        ]);
    }

}