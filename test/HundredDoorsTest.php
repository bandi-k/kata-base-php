<?php

/**
 * Hundred doors problem test.
 */
Namespace Kata\Test;

use Kata\HundredDoors;
use Kata\PrimeFactor\PrimeFactor;

class HundredDoorsTest extends \PHPUnit_Framework_TestCase
{

	/** @var HundredDoors   The HundredDoors instance. */
	protected $hundredDoors = null;

	protected function setUp()
	{
		$this->hundredDoors = new HundredDoors();
	}

	public function testHundredDoors()
	{
		$this->assertEquals(array(true), $this->hundredDoors->getDoors(1));

		$this->assertEquals(array(true, false), $this->hundredDoors->getDoors(2));

		$this->assertEquals(array(true, false, false), $this->hundredDoors->getDoors(3));

		$this->assertEquals(array(true, false, false, true), $this->hundredDoors->getDoors(4));

		$this->assertEquals(array(true, false, false, true, false), $this->hundredDoors->getDoors(5));

		$this->assertEquals(array(true, false, false, true, false, false), $this->hundredDoors->getDoors(6));

		$this->assertEquals(array(true, false, false, true, false, false, false), $this->hundredDoors->getDoors(7));

		$this->assertEquals(array(true, false, false, true, false, false, false, false), $this->hundredDoors->getDoors(8));

		$this->assertEquals(array(true, false, false, true, false, false, false, false, true), $this->hundredDoors->getDoors(9));
	}

	public function testHundredDoorsForSure()
	{
		$primeFactor  = new PrimeFactor();

		$actuallyHundredDoors = $this->hundredDoors->getDoors(100);

		$door100 = $primeFactor->isOddNumber($primeFactor->getCountOfDivisors(100));
		$this->assertEquals($actuallyHundredDoors[99], $door100);

		$door98 = $primeFactor->isOddNumber($primeFactor->getCountOfDivisors(98));
		$this->assertEquals($actuallyHundredDoors[97], $door98);

		$door57 = $primeFactor->isOddNumber($primeFactor->getCountOfDivisors(57));
		$this->assertEquals($actuallyHundredDoors[56], $door57);
	}
}