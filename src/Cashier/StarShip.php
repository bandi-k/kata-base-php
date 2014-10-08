<?php
/**
 * The starship product.
 */
namespace Kata\Cashier;

class Starship extends ProductAbstract
{
	/** The product name. */
	const PRODUCT_NAME_STARSHIP = 'starship';

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->name  = self::PRODUCT_NAME_STARSHIP;
		$this->price = 999.99;
		$this->unit  = 'piece';
	}
}