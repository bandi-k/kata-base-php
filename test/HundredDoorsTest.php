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

		$this->assertEquals([true], $hundredDoors->getDoors(1));

		$this->assertEquals(array(true, false), $hundredDoors->getDoors(2));
	}
}