<?php

/**
 * Class TestArrayChop
 */

namespace Kata\Test\ArrayChop;

use Kata\ArrayChop\ArrayChop;

class ArrayChopTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @param int   $result
	 * @param int   $needle
	 * @param array $haystack
	 *
	 * @dataProvider chopperProvider
	 */
	public function testArrayChop($result, $needle, array $haystack)
	{
		$arrayChop = new ArrayChop();

		$this->assertEquals($result, $arrayChop->start($needle, $haystack));
	}

	/**
	 * Chopper data provider.
	 *
	 * @return array
	 */
	public function chopperProvider()
	{
		return array(
			[-1, 3, []],
			[-1, 3, [1]],
			[0,  1, [1]],
			[0,  1, [1, 3, 5]],
			[1,  3, [1, 3, 5]],
			[2,  5, [1, 3, 5]],
			[-1, 0, [1, 3, 5]],
			[-1, 2, [1, 3, 5]],
			[-1, 4, [1, 3, 5]],
			[-1, 6, [1, 3, 5]],
			[0,  1, [1, 3, 5, 7]],
			[1,  3, [1, 3, 5, 7]],
			[2,  5, [1, 3, 5, 7]],
			[3,  7, [1, 3, 5, 7]],
			[-1, 0, [1, 3, 5, 7]],
			[-1, 2, [1, 3, 5, 7]],
			[-1, 4, [1, 3, 5, 7]],
			[-1, 6, [1, 3, 5, 7]],
			[-1, 8, [1, 3, 5, 7]],
		);
	}
}