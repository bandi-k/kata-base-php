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

}