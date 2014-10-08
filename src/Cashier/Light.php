<?php

/**
 * The light product.
 */
namespace Kata\Cashier;

class Light extends ProductAbstract
{
	/** The product name. */
	const PRODUCT_NAME_LIGHT = 'light';

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->name  = self::PRODUCT_NAME_LIGHT;
		$this->price = 15;
		$this->unit  = 'year';
	}
}