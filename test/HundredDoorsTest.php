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
	}
}