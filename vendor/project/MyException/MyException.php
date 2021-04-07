<?php
namespace Project\MyException;

use \Exception;

class MyException
{
	public static function throw(string $message, int $code = 1)
	{

		throw new Exception($message, $code);

	}
	// .throw
}
// .MyException