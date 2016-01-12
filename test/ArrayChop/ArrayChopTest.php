<?php

/**
 * Class TestArrayChop
 */

namespace Kata\Test\ArrayChop;

use Kata\ArrayChop\ArrayChop;

class ArrayChopTest extends \PHPUnit_Framework_TestCase
{
	public function testArrayChop()
	{
		$arrayChop = new ArrayChop();

		$this->assertEquals(0, $arrayChop->start(0, [0]));
	}
}