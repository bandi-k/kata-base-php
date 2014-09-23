<?php

namespace Kata\Test\PrimeFactor;

use Kata\PrimeFactor\PrimeFactor;

class PrimeFactorTest extends \PHPUnit_Framework_TestCase
{

	/** @var PrimeFactor   The PrimerFactor instance. */
	protected $primeFactor = null;

	protected function setUp()
	{
		$this->primeFactor = new PrimeFactor();
	}

	public function testPrimeFactor()
	{
		$this->assertEquals(array(2), $this->primeFactor->getPrimeFactor(2));
		$this->assertEquals(array(3), $this->primeFactor->getPrimeFactor(3));
		$this->assertEquals(array(2,2), $this->primeFactor->getPrimeFactor(4));
		$this->assertEquals(array(2,3), $this->primeFactor->getPrimeFactor(6));
		$this->assertEquals(array(3,3), $this->primeFactor->getPrimeFactor(9));
		$this->assertEquals(array(2,2,3), $this->primeFactor->getPrimeFactor(12));
		$this->assertEquals(array(3,5), $this->primeFactor->getPrimeFactor(15));
	}

	public function testCountDivisors()
	{
		$this->assertEquals(2, $this->primeFactor->getCountOfDivisors(2));
		$this->assertEquals(2, $this->primeFactor->getCountOfDivisors(3));
		$this->assertEquals(3, $this->primeFactor->getCountOfDivisors(4));
		$this->assertEquals(4, $this->primeFactor->getCountOfDivisors(6));
		$this->assertEquals(3, $this->primeFactor->getCountOfDivisors(9));
		$this->assertEquals(6, $this->primeFactor->getCountOfDivisors(12));
		$this->assertEquals(4, $this->primeFactor->getCountOfDivisors(15));
	}

	public function testIsEvenNumber()
	{
		$this->assertFalse($this->primeFactor->isOddNumber(6));
		$this->assertTrue($this->primeFactor->isOddNumber(11));
		$this->assertFalse($this->primeFactor->isOddNumber(2000006));
		$this->assertTrue($this->primeFactor->isOddNumber(789789711));
	}
}