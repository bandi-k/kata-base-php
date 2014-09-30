<?php

/**
 * The apple product.
 */
namespace Kata\Cashier;

class Apple extends ProductAbstract
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->name  = 'apple';
		$this->price = 32;
		$this->unit  = 'kg';
	}
}