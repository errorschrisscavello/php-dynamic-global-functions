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

