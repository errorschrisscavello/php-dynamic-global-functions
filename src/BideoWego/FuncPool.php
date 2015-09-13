<?php
namespace BideoWego;

class FuncPool
{
	private static $pool;

	public static function get($key)
	{
		self::ensurePoolExists();
		$value = null;
		if (isset(self::$pool[$key])) {
			$value = self::$pool[$key]['callable'];
		}
		return $value;
	}

	public static function set($key, $value)
	{
		self::ensurePoolExists();
		if (!isset(self::$pool[$key])) {
			self::$pool[$key]['defaults'] = self::getDefaults($value);
			self::$pool[$key]['callable'] = $value;
		}
		return self::$pool[$key];
	}

	public static function __callStatic($method, $args)
	{
		if (isset(self::$pool[$method])) {
			$args = self::filterDefaults($method, $args);
			$callable = self::$pool[$method]['callable'];
			return call_user_func_array($callable, $args);
		}
	}

	private static function ensurePoolExists()
	{
		if (!isset(self::$pool)) {
			self::$pool = [];
		}
	}

	private static function filterDefaults($method, $args)
	{
		$filtered = [];
		$defaults = self::$pool[$method]['defaults'];
		$args_length = count($args);
		$defaults_length = count($defaults);
		for($i = 0; $i < $defaults_length; $i++) {
			$value = $defaults[$i];
			if ($i < $args_length) {
				$value = $args[$i];
			}
			array_push($filtered, $value);
		}
		return $filtered;
	}

	private static function getDefaults($callable)
	{
		$refFunc = new \ReflectionFunction($callable);
		$params = $refFunc->getParameters();
		$defaults = [];
		foreach ($params as $param) {
			$value = null;
			if ($param->isDefaultValueAvailable()) {
				$value = $param->getDefaultValue();
			}
			array_push($defaults, $value);
		}
		return $defaults;
	}
}
