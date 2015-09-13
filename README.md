# Bideo Wego Dynamic Global Functions

A small PHP library that allows the dynamic creation of functions in the global namespace at runtime.
Create a function given a string name and closure. Then call it!

# Usage

1. Require the classes

	```php
	require_once __DIR__ . '/vendor/autoload.php';
	```

1. Create a function with `\BideoWego\FuncFactory::create`

	```php
	\BideoWego\FuncFactory::create('my_function', function()
	{
		echo 'Hello World!';
	});
	```

1. Call your newly declared function in the global namespace

	```php
	my_function();
	```
	```shell
	=> "Hello World!"
	```

1. The `\BideoWego\FuncFactory::create` function also supports creating a function with parameters and default parameters!

	```php
	\BideoWego\FuncFactory::create('bar', function($foo, $bar)
	{
		return $foo . $bar;
	});
	```

	```php
	\BideoWego\FuncFactory::create('fiz', function($a=1, $b=2.5, $c=[], $d=false, $e=null)
	{
		return [$a, $b, $c, $d, $e];
	});
	```

1. You may also use it in conjunction with the `use` keyword allowing your global functions to access variables in the scope that you created them in!

	```php
	$biz = 'biz';
	\BideoWego\FuncFactory::create('biz', function() use ($biz)
	{
		return $biz;
	});
	```

