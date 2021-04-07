<?php
namespace Project\File;

use Project\MyException\MyException;

class File
{
	const ERROR_MKDIR = 'Was not possible create the directory';

	public function checkDirectoryExist(string $fileDirectory): bool
	{

		return file_exists($fileDirectory);

	}
	// .checkDirectoryExist

	public function createDirectory(string $fileDirectory): void
	{

		try {

			if (!$this->checkDirectoryExist($fileDirectory)) {

				mkdir($fileDirectory);

			}

		} catch (Exception $e) {

			MyException::throw(
				self::ERROR_MKDIR
				. $fileDir
			);

		}

	}
	// .createDirectory

	public function createFile(string $fileDirectory): void
	{

		try {

			if (!$this->checkDirectoryExist($fileDirectory)) {

				fopen($fileDirectory, 'a+');

			}

		} catch (Exception $e) {

			MyException::throw(
				self::ERROR_MKDIR
				. $fileDir
			);

		}

	}
	// .createFile

	public function write(string $path, string $data): void
	{

		try {

			$this->createFile($path);

			file_put_contents($path, $data);

		} catch (Exception $e) {

			MyException::throw($e->getMessage());

		}

	}
	// .write
}
// .File