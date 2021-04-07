<?php
namespace Project\Model;

use Project\Utils\Utils;

class Model
{
	private $values = [];

	public function getValues()
	{

		return $this->values;

	}
	// .getValues

	public function clearValues()
	{

		$this->values = [];

	}
	// .clearValues

	public function __call($name, $args)
	{

		$method = substr($name, 0, 3);

		$fieldName = substr($name, 3, strlen($name));

		switch ($method) {

			case 'get':

			return (isset($this->values[$fieldName]))
			? Utils::safeEntry($this->values[$fieldName])
			: 0;

			break;

			case 'set':

			$this->values[$fieldName] = Utils::safeEntry($args[0]);

			break;

		}
		// .switch

	}
	// .__call

	public function setData($data = [])
	{

		foreach ($data as $key => $value) {

			//{} é um recurso do PHP que permite a criação dimâmica de atributos para um objet
			$this->{"set" . $key}(str_replace(explode(' ', '# $ % ^ & * ( ) { } < > ~ [ ] ! = ^ ;'), '', Utils::safeEntry($value)));

		}
		// .foreach

	}
	// .setData
}
// .Model