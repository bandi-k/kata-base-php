<?php

namespace Kata\Test\Cashier;

use Kata\Cashier\Cashier;
use Kata\Cashier\Apple;
use Kata\Cashier\Light;
use Kata\Cashier\Starship;


class CashierTest extends \PHPUnit_Framework_TestCase
{

	public function testProducts()
	{
		$apple = new Apple();

		$this->assertInstanceOf('Kata\Cashier\ProductAbstract', $apple);
		$this->assertInstanceOf('Kata\Cashier\Apple', $apple);

		return $apple;
	}

	/**
	 * @depends testProducts
	 */
	public function testApple(Apple $apple)
	{
		$this->assertEquals('apple', $apple->getName());
		$this->assertEquals(32, $apple->getPrice());
		$this->assertEquals('kg', $apple->getUnit());
	}

	public function testCashier()
	{
		$cashier = new Cashier();

		$cashier->addProduct(new Apple());
		$this->assertEquals(32, $cashier->getTotalPrice());

		$cashier->addProduct(new Starship());
		$cashier->addProduct(new Light());
		$this->assertEquals(1046.99, $cashier->getTotalPrice());

		$cashier->addProducts(Apple::PRODUCT_NAME_APPLE, 5);
		$this->assertEquals(1206.99, $cashier->getTotalPrice());

		$cashier->addProducts(Light::PRODUCT_NAME_LIGHT, 1);
		$this->assertEquals(1221.99, $cashier->getTotalPrice());

		$cashier->addProducts(Starship::PRODUCT_NAME_STARSHIP, 1);
		$this->assertEquals(2221.98, $cashier->getTotalPrice());
	}

	public function testCashierWithMock()
	{
		$appleMock = $this->getMock('Kata\Cashier\Apple');

		$appleMock->method('getPrice')->willReturn(32);

		$cashier = new Cashier();

		$cashier->addProduct($appleMock);
		$cashier->addProduct($appleMock);

		$this->assertEquals(64, $cashier->getTotalPrice());
	}

	/**
	 * @expectedException  \InvalidArgumentException
	 */
	public function testInvalidArgumentException()
	{
		$cashier = new Cashier();

		$cashier->addProducts('poulet', 1);
	}
}