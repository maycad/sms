<?php
namespace MayCad\SMS\Providers;

/**
 * 
 */
class Twilio extends Provider
{
	private $_sid, $_token;

	function __construct(array $data)
	{
		$this->hydrate($data);
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
		# code...
	}

	public function call(string $to, array $params = array())
	{
		# code...
	}
}