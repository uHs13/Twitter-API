<?php
namespace Project\Template;

use Project\MyException\MyException;
use Project\File\File;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Template
{
	const ERROR_FILE = 'inexistent file';
	const ERROR_VIEW = 'inexistent views directory';
	const ERROR_CACHE = 'inexistent cache directory';

	private $loader;
	private $twig;
	private $tplDir;
	private $options = [

		'debug' => true,
		'charset' => 'utf-8',
		'auto_reload' => true,
		'optimizations' => -1,
		'cache' => ''

	];

	public function __construct(
		string $tplDir = '/views/',
		string $cacheDir = '/views-cache/'
	) {

		$baseDir = $_SERVER['DOCUMENT_ROOT']
		. DIRECTORY_SEPARATOR
		. 'Twitter'
		. DIRECTORY_SEPARATOR;

		$this->tplDir = $baseDir
		. $tplDir;

		$cacheDir = $baseDir
		. $cacheDir;

		$this->initLoader();

		$this->initCacheDir($cacheDir);

		$this->initTwig();

	}
	// .__construct

	public function initCacheDir(string $path)
	{

		$file = new File();

		$file->createDirectory($path);

		$this->options['cache'] = $path;

	}
	// .initCacheDir

	public function initLoader()
	{

		$file = new File();

		$file->createDirectory($this->tplDir);

		$this->loader = new FilesystemLoader($this->tplDir);

	}
	// .defineTemplatePath

	public function initTwig()
	{

		$this->twig = new Environment(
			$this->loader,
			$this->options
		);

	}
	// .initTwig

	public function checkTemplateExist(string $tempName): string
	{

		$twigExt = $tempName . '.twig';
		$htmlExt = $tempName . '.html';

		if (file_exists($this->tplDir . DIRECTORY_SEPARATOR . $twigExt)) {

			return $twigExt;

		} elseif (file_exists($this->tplDir . DIRECTORY_SEPARATOR . $htmlExt)) {

			return $htmlExt;

		} else {

			MyException::throw(self::ERROR_FILE);

		}

	}
	// .checkTemplateExist

	public function displayTemplate(string $tempName, $vars = [])
	{

		$this->twig->display($tempName, $vars);

	}
	// .displayTemplate

	public function show(string $tempName, array $vars = []): void
	{

		$this->displayTemplate(
			$this->checkTemplateExist($tempName),
			$vars
		);

	}
	// .showTemplate
}
// .Template