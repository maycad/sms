<?php
namespace MayCad\SMS\Providers;

use SMSFactor\SMSFactor;
use SMSFactor\Message;
/**
 * 
 */
class SMSFactor extends Provider
{
	private $_token;

	private $_sms;

	function __construct(array $data)
	{
		$this->hydrate($data);

		$this->_sms = SMSFactor::setApiToken($this->getToken());
	}

	public function setToken(string $token)
	{
		$this->_token = $token;

		return $this;
	}

	public function getToken()
	{
		return $this->_token;
	}

	public function hydrate(array $data)
	{
		foreach ($data as $key => $value) {
			
			$method = 'set' . ucfirst($key);

			if (method_exists($this, $method)) {
				$this->$method($value);
			}

		}
	}

	public function send(string $to, string $text)
	{
		$res = Message::send(['to' => $to, 'text' => $text]);

		return $res->getJson();
	}
}