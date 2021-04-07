<?php

use Psr\Http\Message\ServerRequestInterface as Req;
use Psr\Http\Message\ResponseInterface as Res;
use Project\Template\TemplateTwitter as Template;
use Project\Session\SessionInteract as Session;

$app->get('/', function (Req $req, Res $res, array $args) {

	$template = new Template();

	$template->show('tweet', [

		'error' => Session::getSessionMsgError(),
		'success' => Session::getSessionMsgSuccess(),
		'content' => Session::getSessionInputContent(),

	]);

});

$app->get('/tweet-media', function (Req $req, Res $res, array $args) {

	$template = new Template();

	$template->show('tweetmedia', [

		'error' => Session::getSessionMsgError(),
		'success' => Session::getSessionMsgSuccess(),
		'content' => Session::getSessionInputContent(),

	]);

});