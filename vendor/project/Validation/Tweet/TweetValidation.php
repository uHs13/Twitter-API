<?php
namespace Project\Validation\Tweet;

use Project\Validation\Abst\AbstractValidate;

class TweetValidation extends AbstractValidate
{
	public function __construct(array $values)
	{

		$this->setFields();

		parent::__construct($values);

	}
	// .__construct

	public function setFields(): void
	{

		$this->fields = $this->getTweetFieldsValidation();

	}
	// .setFields

	public static function getTweetFieldsValidation(): array
	{

		return [

			['tweet', 'What´s happening', 1, 280]

		];

	}
	// .getTweetFieldsValidation
}
// .TweetValidation