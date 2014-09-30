<?php

/**
 * Smart cashier class.
 */
namespace Kata\Cashier;

class Cashier
{
	/** @var array   The products. */
	protected $basket = array();

	/**
	 * Adds a product to the basket.
	 *
	 * @param ProductAbstract $product   The product.
	 */
	public function addProduct(ProductAbstract $product)
	{
		$this->basket[] = $product;
	}

	/**
	 * Returns the total price of the basket.
	 *
	 * @return int
	 */
	public function getTotalPrice()
	{
		$totalPrice = 0;

		/** @var ProductAbstract $product */
		foreach ($this->basket as $product)
		{
			$totalPrice += $product->getPrice();
		}

		return $totalPrice;
	}
}