<?php

/**
 * The light product.
 */
namespace Kata\Cashier;

class Light extends ProductAbstract
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->name  = 'light';
		$this->price = 15;
		$this->unit  = 'year';
	}
}