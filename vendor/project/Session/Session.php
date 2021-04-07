<?php
namespace Project\Session;

use Project\Utils\Utils;

class Session
{
	public function setName(string $name)
	{

		$name = Utils::opensslencrypt($name);

		session_name($name);

	}
	// .setName

	public function setContent(string $key, array $data)
	{

		$this->regenerateId();

		$_SESSION[$key] = Utils::opensslencrypt($data);

	}
	// .setData

	public function setStringContent(string $key, string $data)
	{

		$this->regenerateId();

		$_SESSION[$key] = Utils::opensslencrypt($data);

	}
	// .setData

	public function getContent(string $key)
	{

		if (isset($_SESSION)) {

			if (isset($_SESSION[$key]) && $_SESSION[$key] != null) {

				$this->regenerateId();

				return Utils::safeEntry(Utils::openssldecrypt($_SESSION[$key]));

			}

		}

		return null;

	}
	// .getContent

	public function start()
	{

		session_start();

	}
	// .start

	public function regenerateId()
	{

		session_regenerate_id();

	}
	// .regenerateId

	public function unsetData(string $key)
	{

		if (isset($_SESSION[$key])) {

			$_SESSION[$key] = null;
			//All PHP reserved keywords and types MUST be in lower case.
			//https://www.php-fig.org/psr/psr-12/

		}

	}
	// .unsetData
}
// .Session