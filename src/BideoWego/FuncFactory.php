<?php
namespace BideoWego;

class FuncFactory
{
	public static function create($name, $callable)
	{
		FuncPool::set($name, $callable);
		$string = 'function ' . $name . '()';
		$string .= '{';
		$string .= '$args = func_get_args();';
		$string .= 'return call_user_func_array("\BideoWego\FuncPool::' . $name . '", $args);';
		$string .= '}';
		eval($string);
	}
}