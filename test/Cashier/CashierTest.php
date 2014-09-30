<?php

namespace Kata\Test\Cashier;

use Kata\Cashier\Cashier;
use Kata\Cashier\Apple;
use Kata\Cashier\Light;
use Kata\Cashier\Starship;


class CashierTest extends \PHPUnit_Framework_TestCase
{
	public function testCashier()
	{
		$cashier = new Cashier();

		$cashier->addProduct(new Apple());
		$this->assertEquals(32, $cashier->getTotalPrice());

		$cashier->addProduct(new Starship());
		$cashier->addProduct(new Light());
		$this->assertEquals(1046.99, $cashier->getTotalPrice());

		$cashier->addProducts('light', 5);
		$this->assertEquals(1121.99, $cashier->getTotalPrice());
	}

	public function testProducts()
	{
		$apple = new Apple();

		$this->assertInstanceOf('Kata\Cashier\ProductAbstract', $apple);
		$this->assertInstanceOf('Kata\Cashier\Apple', $apple);
	}

	public function testApple()
	{
		$apple = new Apple();

		$this->assertEquals('apple', $apple->getName());
		$this->assertEquals(32, $apple->getPrice());
		$this->assertEquals('kg', $apple->getUnit());
	}
}