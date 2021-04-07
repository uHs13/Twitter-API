<?php
namespace Project\Validation\Abst;

use Project\Interf\ValidateInterface;
use Project\MyException\MyException;
use Project\Model\Model;

abstract class AbstractValidate extends Model implements ValidateInterface
{
	protected $fields = [];

	public function __construct($array)
	{

		$this->setData($array);

	}
	//.__construct

	public function validate(): void
	{

		foreach ($this->fields as $value) {

			if (!isset($this->getValues()[$value[0]])) {

				MyException::throw('Form Error');

			} elseif (strlen($this->{'get' . $value[0]}()) < $value[2]) {

				if (strlen($this->{'get' . $value[0]}()) === 0) {

					MyException::throw('Fill the field '. $value[1]);

				} else {

					MyException::throw(
						'The field'
						. $value[1] 
						. ' minimun length is'
						. $value[2]
						. ' characters'
					);

				}

			} elseif (strlen($this->{'get' . $value[0]}()) > $value[3]) {

				MyException::throw(
					'The field '
					. $value[1]
					. ' exceeded the '
					. $value[3]
					. ' characters limit'
				);

			}

		}

	}
	//.validate
}
// .AbstractValidate