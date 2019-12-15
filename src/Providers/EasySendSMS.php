<?php
namespace MayCad\SMS\Providers;

/**
 * 
 */
class EasySendSMS extends Provider
{
	const BASE_URI = 'https://www.easysendsms.com/sms/bulksms-api/';
	
	private $_username, $_password, $_from;

	function __construct(array $data)
	{
		parent::__construct(['base_uri' => self::BASE_URI]);

		$this->hydrate($data);
	}

	public function send(string $to, string $text, int $type = 0)
	{
		$req = $this->getClient()->get('bulksms-api', [
            'query' => [
            	'username' => $this->getUsername(),
            	'password' => $this->getPassword(),
            	'from' => $this->getFrom(),
            	'to' => $to,
            	'text' => $text,
            	'type' => $type
            ],
        ]);

        return json_decode($req->getBody());
	}

	public function setUsername(string $username)
	{
		$this->_username = $username;

		return $this;
	}

	public function getUsername()
	{
		return $this->_username;
	}

	public function setPassword(string $password)
	{
		$this->_password = $password;

		return $this;
	}

	public function getPassword()
	{
		return $this->_password;
	}

	public function setFrom(string $from)
	{
		$this->_from = $from;

		return $this;
	}

	public function getFrom()
	{
		return $this->_from;
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
}