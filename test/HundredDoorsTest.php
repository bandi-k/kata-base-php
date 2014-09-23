<?php

/**
 * Hundred doors problem test.
 */
Namespace Kata\Test;

use Kata\HundredDoors;
use Kata\PrimeFactor\PrimeFactor;

class HundredDoorsTest extends \PHPUnit_Framework_TestCase
{

	public function testHundredDoors()
	{
		$hundredDoors = new HundredDoors();

		$this->assertEquals(array(true), $hundredDoors->getDoors(1));

		$this->assertEquals(array(true, false), $hundredDoors->getDoors(2));

		$this->assertEquals(array(true, false, false), $hundredDoors->getDoors(3));

		$this->assertEquals(array(true, false, false, true), $hundredDoors->getDoors(4));

		$this->assertEquals(array(true, false, false, true, false), $hundredDoors->getDoors(5));

		$this->assertEquals(array(true, false, false, true, false, false), $hundredDoors->getDoors(6));

		$this->assertEquals(array(true, false, false, true, false, false, false), $hundredDoors->getDoors(7));

		$this->assertEquals(array(true, false, false, true, false, false, false, false), $hundredDoors->getDoors(8));

		$this->assertEquals(array(true, false, false, true, false, false, false, false, true), $hundredDoors->getDoors(9));
	}

	public function testHundredDoorsForSure()
	{
		$hundredDoors = new HundredDoors();
		$primeFactor  = new PrimeFactor();

		$actuallyHundredDoors = $hundredDoors->getDoors(100);

		$door100 = $primeFactor->isOddNumber($primeFactor->getCountOfDivisors(100));
		$this->assertEquals($actuallyHundredDoors[99], $door100);

		$door98 = $primeFactor->isOddNumber($primeFactor->getCountOfDivisors(98));
		$this->assertEquals($actuallyHundredDoors[97], $door98);

		$door57 = $primeFactor->isOddNumber($primeFactor->getCountOfDivisors(57));
		$this->assertEquals($actuallyHundredDoors[56], $door57);
	}
}