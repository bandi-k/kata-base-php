<?php

/**
 * Hundred doors problem test.
 */
Namespace Kata\Test;

use Kata\HundredDoors;

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
}