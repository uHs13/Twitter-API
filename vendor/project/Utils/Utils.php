<?php
namespace Project\Utils;

use Project\Keys\Keys;

class Utils
{
	public static function safeEntry($item)
	{

		switch (gettype($item)) {

			case 'array':

			foreach ($item as $key => &$value) {

				$value =  Utils::safeEntry($value);

			}

			break;

			case 'string':
			case 'int':

			$item = escapeshellcmd(
				strip_tags(
					trim(
						Utils::removeAccent($item)
					)
				)
			);

			break;

		}

		return $item;

	}
	// .safeEntry

	public static function removeAccent($value)
	{

		$map = array(
			'á' => 'a',
			'à' => 'a',
			'ã' => 'a',
			'â' => 'a',
			'é' => 'e',
			'ê' => 'e',
			'í' => 'i',
			'î' => 'i',
			'ó' => 'o',
			'ô' => 'o',
			'õ' => 'o',
			'ú' => 'u',
			'ü' => 'u',
			'ç' => 'c',
			'Á' => 'A',
			'À' => 'A',
			'Ã' => 'A',
			'Â' => 'A',
			'É' => 'E',
			'Ê' => 'E',
			'Í' => 'I',
			'Ó' => 'O',
			'Ô' => 'O',
			'Õ' => 'O',
			'Ú' => 'U',
			'Ü' => 'U',
			'Ç' => 'C'
		);

		$value = strtr($value, $map);

		return $value;

	}
	//.removeAccent

	public static function opensslencrypt($data)
	{

		$openssl = base64_encode(openssl_encrypt(
			json_encode($data), 
			'AES-256-OFB', 
			Keys::SECRET,
			0,
			Keys::SECRETIV
		));

		return $openssl;

	}
	// .openssldecrypt

	public static function openssldecrypt($data)
	{

		$decrypt = openssl_decrypt(
			base64_decode($data), 
			'AES-256-OFB', 
			Keys::SECRET,
			0,
			Keys::SECRETIV
		);

		return json_decode($decrypt, true);

	}
	// .openssldecrypt
}
// .Utils