<?php
namespace MayCad\SMS\Providers;

use Twilio\Rest\Client;
/**
 * 
 */
class Twilio extends Provider
{
	private $_sid, $_token, $_phone;

	private $_client;

	function __construct(array $data)
	{
		$this->hydrate($data);

		$this->_client = new Client($this->getSid(), $this->getToken());
	}

	public function setSid(string $sid)
	{
		$this->_sid = $sid;

		return $this;
	}

	public function getSid()
	{
		return $this->_sid;
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

	public function setPhone(string $phone)
	{
		$this->_phone = $phone;

		return $this;
	}

	public function getPhone()
	{
		return $this->_phone;
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

	public function send(string $to, string $body)
	{
		return $this->_client->messages->create($to,
			array('from' => $this->getPhone(), 'body' => $body)
		);
	}

	public function call(string $to, array $params = array())
	{
		return $this->_client->calls->create($to, $this->getPhone(), $params);
	}
}