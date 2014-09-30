<?php

/**
 * The abstract class of products.
 */
namespace Kata\Cashier;

abstract class ProductAbstract
{

	/** @var string   The product's name. */
	protected $name = null;
	/** @var float   The product's price. */
	protected $price = null;
	/** @var string   The product's unit type. */
	protected $unit = null;

	/**
	 * Returns the name.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Returns the price.
	 *
	 * @return float
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Returns the unit.
	 *
	 * @return string
	 */
	public function getUnit()
	{
		return $this->unit;
	}
}