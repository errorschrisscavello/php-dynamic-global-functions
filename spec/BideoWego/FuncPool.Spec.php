<?php
require_once __DIR__.'/../SpecHelper.php';

use BideoWego\FuncPool;

describe('FuncPool', function()
{
	describe('::get', function()
	{
		it('returns the function stored at the given key', function()
		{
			FuncPool::set('foo', function()
			{
				return 'foo';
			});
			$callable = FuncPool::get('foo');
			expect($callable())->to->equal('foo');
		});
	});

	describe('::set', function()
	{
		it('sets the key to the given key and value to the given function', function()
		{
			FuncPool::set('bar', function()
			{
				return 'bar';
			});
			$callable = FuncPool::get('bar');
			expect($callable())->to->equal('bar');
		});
	});

	describe('__callStatic', function()
	{
		it('forwards the call of a missing method to the same name in the function pool', function()
		{
			FuncPool::set('fiz', function()
			{
				return 'fiz';
			});
			expect(FuncPool::fiz())->to->equal('fiz');
		});
	});
});