<?php

/**
 * The apple product.
 */
namespace Kata\Cashier;

class Apple extends ProductAbstract
{
	/** The product name. */
	const PRODUCT_NAME_APPLE = 'apple';

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->name  = self::PRODUCT_NAME_APPLE;
		$this->price = 32;
		$this->unit  = 'kg';
	}
}