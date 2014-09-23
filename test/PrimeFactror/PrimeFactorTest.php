<?php

namespace Kata\Test\PrimeFactor;

use Kata\PrimeFactor\PrimeFactor;

class PrimeFactorTest extends \PHPUnit_Framework_TestCase
{

	public function testPrimeFactor()
	{
		$primeFactor = new PrimeFactor();

		$this->assertEquals(array(2), $primeFactor->getPrimeFactor(2));
		$this->assertEquals(array(3), $primeFactor->getPrimeFactor(3));
		$this->assertEquals(array(2,2), $primeFactor->getPrimeFactor(4));
		$this->assertEquals(array(2,3), $primeFactor->getPrimeFactor(6));
		$this->assertEquals(array(3,3), $primeFactor->getPrimeFactor(9));
		$this->assertEquals(array(2,2,3), $primeFactor->getPrimeFactor(12));
		$this->assertEquals(array(3,5), $primeFactor->getPrimeFactor(15));
	}

	public function testCountDivisors()
	{
		$primeFactor = new PrimeFactor();

		$this->assertEquals(2, $primeFactor->getCountOfDivisors(2));
		$this->assertEquals(2, $primeFactor->getCountOfDivisors(3));
		$this->assertEquals(3, $primeFactor->getCountOfDivisors(4));
		$this->assertEquals(4, $primeFactor->getCountOfDivisors(6));
		$this->assertEquals(3, $primeFactor->getCountOfDivisors(9));
		$this->assertEquals(6, $primeFactor->getCountOfDivisors(12));
		$this->assertEquals(4, $primeFactor->getCountOfDivisors(15));
	}

	public function testIsEvenNumber()
	{
		$primeFactor = new PrimeFactor();

		$this->assertTrue($primeFactor->isEvenNumber(6));
		$this->assertFalse($primeFactor->isEvenNumber(11));
		$this->assertTrue($primeFactor->isEvenNumber(2000006));
		$this->assertFalse($primeFactor->isEvenNumber(789789711));
	}
}