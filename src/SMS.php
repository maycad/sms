<?php
namespace MayCad\SMS;

use MayCad\SMS\Providers\EasySendSMS;
use MayCad\SMS\Providers\Twilio;
use MayCad\SMS\Providers\Provider;

/**
 * 
 */
class SMS
{
	private $_provider;
	private $_params = array();

	public function __construct(array $params = array(), string $provider = 'EasySendSMS')
	{
		$this->setParams($params);
		$this->setProvider($provider);

		$this->with($params, $provider);
	}

	public function setParams(array $params)
	{
		$this->_params = $params;

		return $this;
	}

	public function getParams()
	{
		return $this->_params;
	}

	public function setProvider(string $provider)
	{
		$this->_provider = $provider;

		return $this;
	}

	public function getProvider()
	{
		return $this->_provider;
	}

	public function with(array $params, string $provider)
	{
		$method = 'with' . ucfirst($provider);

		if (method_exists($this, $method)) {
			return $this->$method($params);
		}

		throw new Exception("Error Processing Request", 1);
	}

	public function withEasySendSMS(array $params)
	{
		return new EasySendSMS($params);
	}

	public function withTwilio(array $params)
	{
		return new Twilio($params);
	}

	public function send(string $to, string $msg)
	{
		$this->with($this->getParams(), $this->getProvider())->send($to, $msg);
	}
}