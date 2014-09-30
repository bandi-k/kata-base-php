<?php

namespace Kata\Test\Cashier;

use Kata\Cashier\Cashier;
use Kata\Cashier\Apple;


class CashierTest extends \PHPUnit_Framework_TestCase
{
	public function testCashier()
	{
		$cashier = new Cashier();

		$this->assertEquals(1, $cashier->getTotalPrice());
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