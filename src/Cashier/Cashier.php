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
	 * @param object $product   The product.
	 */
	public function addProduct($product)
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

	/**
	 * Adds products to the basket.
	 *
	 * @param string $productName   The product name.
	 * @param int    $count         The product count.
	 */
	public function addProducts($productName, $count = 1)
	{
		for ($i = 1; $i <= $count; $i++) {
			$this->basket[] = $this->productFactory($productName);
		}
	}

	/**
	 * Returns a product.
	 *
	 * @param string $productName   The name of the product.
	 *
	 * @return ProductAbstract   The product.
	 */
	protected function productFactory($productName)
	{
		switch ($productName) {
			case 'apple':
				return new Apple();
				break;
			case 'light':
				return new Light();
				break;
			case 'starship':
				return new Starship();
				break;
			default:
				trigger_error('Product does not exist!', E_USER_ERROR);
				break;
		}
	}
}