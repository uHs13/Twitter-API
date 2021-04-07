<?php
namespace Project\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use Project\Model\Model;
use Project\Utils\Utils;

class Twitter extends Model
{
	const ERROR_TWEET = 'Something goes wrong :/';

	public function __construct()
	{

		$this->setconsumerKey(
			'insert the key'
		);

		$this->setconsumerSecret(
			'insert the key'
		);

		$this->setaccessToken(
			'insert the key'
		);

		$this->setaccessSecret(
			'insert the key'
		);

		$this->verifyCredentials();

	}
	// .__construct

	public function verifyCredentials()
	{

		$connection = new TwitterOAuth(
			$this->getconsumerKey(),
			$this->getconsumerSecret(),
			$this->getaccessToken(),
			$this->getaccessSecret()
		);

		$this->setconnection($connection);

		$this->getconnection()->get(
			'account/verify_credentials'
		);

	}
	// .verifyCredentials

	public function checkLastHttpCode(): void
	{

		if ($this->getconnection()->getLastHttpCode() !== 200) {

			MyException::throw(self::ERROR_TWEET);

		}

	}
	// .checkLastHttpCode

	public function uploadMedias(array $paths): array
	{

		$mediaIds = [];

		try {

			foreach ($paths as $path) {

				array_push(
					$mediaIds,
					$this->uploadMedia($path)
				);

			}

			return $mediaIds;

		} catch (Exception $e) {

			MyException::throw($e->getMessage());

		}

	}
	// .uploadMedias

	public function uploadMedia(string $path): string
	{

		try {

			return $this->getconnection()->upload(
				'media/upload',
				['media' => $path]
			)->media_id_string;

		} catch (Exception $e) {

			MyException::throw($e->getMessage());

		}

	}
	// .uploadMedia

	public function newStatus(string $message): void
	{

		try {

			$this->getconnection()->post(
				'statuses/update',
				[
					'status' => $message
				]
			);

			$this->checkLastHttpCode();

		} catch (Exception $e) {

			MyException::throw(self::ERROR_TWEET);

		}

	}
	// .newStatus

	public function newStatusMedia(string $message, array $paths): void
	{

		try {

			$mediaIds = $this->uploadMedias($paths);

			$this->getconnection()->post(
				'statuses/update',
				[
					'status' => $message,
					'media_ids' => implode(',', $mediaIds)
				]
			);

			$this->checkLastHttpCode();

		} catch (Exception $e) {

			MyException::throw(self::ERROR_TWEET);

		}

	}
	// .newStatusMedia
}
// .Twitter
