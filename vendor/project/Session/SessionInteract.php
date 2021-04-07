<?php
namespace Project\Session;

use Project\Session\Session;
use Project\Utils\Utils;

class SessionInteract
{
	const SESSION_ERROR = "sessionError";
	const SESSION_SUCCESS = "sessionSuccess";
	const SESSION_INPUT_CONTENT = "sessionInputContent";

	public static function setSessionMsgError($msg)
	{

		$session = new Session();

		$session->setStringContent(
			self::SESSION_ERROR,
			$msg
		);

	}
	// .setMsgError

	public static function getSessionMsgError()
	{

		$session = new Session();

		$msg = $session->getContent(
			self::SESSION_ERROR
		);

		$session->unsetData(
			self::SESSION_ERROR
		);

		return isset($msg) ? $msg : "";

	}
	// .getMsgError

	public static function setSessionMsgSuccess($msg)
	{

		$session = new Session();

		$session->setStringContent(
			self::SESSION_SUCCESS,
			$msg
		);

	}
	// .setMsgError

	public static function getSessionMsgSuccess()
	{

		$session = new Session();

		$msg = $session->getContent(
			self::SESSION_SUCCESS
		);

		$session->unsetData(
			self::SESSION_SUCCESS
		);

		return isset($msg) ? $msg : "";

	}
	// .getMsgSuccess

	public static function setSessionInputContent(array $content)
	{

		$session = new Session();

		$session->setContent(
			self::SESSION_INPUT_CONTENT,
			$content
		);

	}
	// .content

	public static function getSessionInputContent()
	{

		$session = new Session();

		$array = $session->getContent(
			self::SESSION_INPUT_CONTENT
		);

		$session->unsetData(
			self::SESSION_INPUT_CONTENT
		);

		return isset($array) ? $array : [];

	}
	// .getSessionInputContent
}
// .SessionInteract