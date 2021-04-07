<?php
namespace Project\Image;

use Project\Model\Model;
use Project\File\File;
use Project\File\Dir;

class Image extends Model
{
	public function buildImage($base64, $name): void
	{

		$image = explode(",", $base64);

		$extension = $this->getImageBase64Extension($base64);

		$file = new File();

		$file->write(
			$_SERVER['DOCUMENT_ROOT']
			. DIRECTORY_SEPARATOR
			. 'Twitter'
			. DIRECTORY_SEPARATOR
			. 'upload'
			. DIRECTORY_SEPARATOR
			. $name
			. '.'
			. $extension,
			base64_decode($image[1])
		);

	}
	//.buildImage

	public function getImageBase64Extension($base64): string
	{

		$image = explode(",", $base64);

		$extension = explode(";", explode("/", $image[0])[1])[0];

		return $extension;

	}
	//.getImageBase64Extension

	public function clearBase64($value): string
	{

		return strip_tags(trim($value));

	}
	//.singleSafeEntry
}
//.Image