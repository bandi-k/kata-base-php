<?php

/**
 * Class TestArrayChop
 */

namespace Kata\Test\ArrayChop;

use Kata\ArrayChop\ArrayChop;

class ArrayChopTest extends \PHPUnit_Framework_TestCase
{
	/** @var ArrayChop   The array chop. */
	protected $arrayChop;

	public function setUp()
	{
		$this->arrayChop = new ArrayChop();
	}

	/**
	 * @param int   $result
	 * @param int   $needle
	 * @param array $haystack
	 *
	 * @dataProvider chopperProvider
	 */
	public function testArrayChop($result, $needle, array $haystack)
	{
		$this->assertEquals($result, $this->arrayChop->start($needle, $haystack));
	}

	/**
	 * @param $needle
	 *
	 * @dataProvider invalidNeedleProvider
	 * @expectedException \Kata\ArrayChop\InvalidNeedleException
	 */
	public function testInvalidNeedle($needle)
	{
		$this->arrayChop->start($needle, []);
	}

	/**
	 * @expectedException \Kata\ArrayChop\InvalidHaystackException
	 */
	public function testInvalidHaystack()
	{
		$this->arrayChop->start(0, ['33']);
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

	/**
	 * Invalid needle provider.
	 *
	 * @return array
	 */
	public function invalidNeedleProvider()
	{
		return array(
			['22'],
			[22.22],
			[[22]],
		);
	}
}