<?php
/**
 * The starship product.
 */
namespace Kata\Cashier;

class Starship extends ProductAbstract
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->name  = 'starship';
		$this->price = 999.99;
		$this->unit  = 'piece';
	}
}