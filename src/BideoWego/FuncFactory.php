<?php
namespace BideoWego;

class FuncFactory
{
	public static function create($name, $callable)
	{
		$callable_name = '_' . md5($name);
		FuncPool::set($callable_name, $callable);
		$string = 'function ' . $name . '()';
		$string .= '{';
		$string .= '$args = func_get_args();';
		$string .= 'return call_user_func_array("\BideoWego\FuncPool::' . $callable_name . '", $args);';
		$string .= '}';
		eval($string);
	}
}