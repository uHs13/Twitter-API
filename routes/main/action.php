<?php

use Project\Validation\Base64\Base64Validation as Base64Validation;
use Project\Validation\Tweet\TweetValidation as Validation;
use Project\Session\SessionInteract as Session;
use Project\Twitter\Twitter;
use Project\Image\Image;
use Psr\Http\Message\ServerRequestInterface as Req;
use Psr\Http\Message\ResponseInterface as Res;

$app->post('/', function (Req $req, Res $res, array $args) {

	try {

		$validation = new Validation(
			$req->getParsedBody()
		);

		$validation->validate();

		$twitter = new Twitter();

		$twitter->newStatus(
			$req->getParsedBody()['tweet']
		);

		Session::setSessionMsgSuccess('Posted');

	} catch (Exception $e) {

		Session::setSessionMsgError(
			$e->getMessage()
		);

		Session::setSessionInputContent(
			$req->getParsedBody()
		);

	}

	Session::setSessionInputContent([
		'tweet' => '',
		'blackMode' => $req->getParsedBody()['blackMode']
	]);

	return $res->withStatus(200)->withRedirect('/twitter');

});

$app->post('/tweet-media', function (Req $req, Res $res, array $args) {

	try {

		$base64Validation = new Base64Validation();

		$base64Validation->validate(
			$req->getParsedBody()['base64']
		);

		$fileName = 'user-upload';

		$image = new Image();

		$image->buildImage(
			$req->getParsedBody()['base64'],
			$fileName
		);

		$validation = new Validation([
			'tweet' => $req->getParsedBody()['tweet']
		]);

		$validation->validate();

		$twitter = new Twitter();

		$twitter->newStatusMedia(
			$req->getParsedBody()['tweet'],
			[
				$_SERVER['DOCUMENT_ROOT']
				. DIRECTORY_SEPARATOR
				. 'Twitter'
				. DIRECTORY_SEPARATOR
				. 'upload'
				. DIRECTORY_SEPARATOR
				. $fileName
				. '.'
				. $image->getImageBase64Extension(
					$req->getParsedBody()['base64']
				)
			]
		);

		Session::setSessionMsgSuccess('Posted');

	} catch (Exception $e) {

		Session::setSessionMsgError(
			$e->getMessage()
		);

		Session::setSessionInputContent([
			'tweet' => $req->getParsedBody()['tweet'],
			'blackMode' => $req->getParsedBody()['blackMode']
		]);

		return $res->withStatus(200)->withRedirect('/twitter/tweet-media');

	}

	Session::setSessionInputContent([
		'tweet' => '',
		'blackMode' => $req->getParsedBody()['blackMode']
	]);

	return $res->withStatus(200)->withRedirect('/twitter/tweet-media');

});