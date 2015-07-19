<?php
namespace common\base;
use common\data\Session;
use common\milk\inject\Injector;

/**
 * Class BaseAutoload
 * @package common\base
 */
abstract class Autoload {
	/* @var Injector */
	private static $injector = null;

	/**
	 * Initializes the website.
	 * Sets up auto-loading, milk injector, and session.
	 * @param Autoload $autoload
	 */
	public static function init(Autoload $autoload) {
		// Set up auto-loading
		spl_autoload_register(function ($className) use ($autoload) {
			// Replace namespace backslashes with folder directory forward slashes
			$className = str_replace("\\", "/", $className);

			// Normal PHP path
			$path = dirname(__FILE__) . "/../../" . $className . ".php";
			if (file_exists($path)) {
				/** @noinspection PhpIncludeInspection */
				include_once($path);
			}

			// PHPTests path
			$path = dirname(__FILE__) . "/../../tests/" . $className . ".php";
			if (file_exists($path)) {
				/** @noinspection PhpIncludeInspection */
				include_once($path);
			}
		});

		// Set up Milk
		self::$injector = $autoload->getMilkInjector();

		// Set up session
		Session::start(Settings::SESSION_NAME);
	}

	// Getters
	/**
	 * Gets the milk injector
	 * @return Injector
	 */
	public static function getInjector() {
		return self::$injector;
	}

	/**
	 * Returns injector associated to the website
	 * @return Injector
	 */
	protected abstract function getMilkInjector();
}