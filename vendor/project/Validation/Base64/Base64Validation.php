<?php
namespace Project\Validation\Base64;

use Project\MyException\MyException;

class Base64Validation
{
	const ERROR_BASE64 = 'Invalid Image';

	public function validate(string $base64): void
	{

		if (strlen($base64) === 0 || strlen($base64) > 10**25) {

			MyException::throw(self::ERROR_BASE64);

		}

	}
	// .validate
}
// .Base64Validation