<?php

namespace Kata\Test\Cashier;

use Kata\Cashier\Cashier;

class CashierTest extends \PHPUnit_Framework_TestCase
{
	public function testCashier()
	{
		$cashier = new Cashier();

		$this->assertEquals(1, $cashier->getTotalPrice());
	}
}