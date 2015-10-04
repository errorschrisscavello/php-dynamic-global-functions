<?php
require_once __DIR__.'/../SpecHelper.php';

use BideoWego\FuncFactory;

describe('FuncFactory', function()
{
	describe('::create', function()
	{
		it('defines a function callable in the global namespace', function()
		{
			FuncFactory::create('foo', function()
			{
				return 'foo';
			});
			expect(foo())->to->equal('foo');
		});

		it('allows the functions to accept parameters', function()
		{
			FuncFactory::create('bar', function($foo, $bar)
			{
				return $foo . $bar;
			});
			expect(bar('foo', 'bar'))->to->equal('foobar');
		});

		it('allows various parameter defaults', function()
		{
			FuncFactory::create('fiz', function($a=1, $b=2.5, $c=[], $d=false, $e=null)
			{
				return [$a, $b, $c, $d, $e];
			});
			expect(fiz())->to->equal([1, 2.5, [], false, null]);
		});

		it('overrides default parameters with only the passed ones', function()
		{
			FuncFactory::create('baz', function($a=1, $b=2, $c=3)
			{
				return [$a, $b, $c];
			});
			expect(baz('baz'))->to->equal(['baz', 2, 3]);
		});

		it('benefits from the use keyword allowing variables in scope to be accessed', function()
		{
			$biz = 'biz';
			FuncFactory::create('biz', function() use ($biz)
			{
				return $biz;
			});
			expect(biz())->to->equal('biz');
		});
	});
});