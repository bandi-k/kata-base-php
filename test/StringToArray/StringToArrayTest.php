<?php

/**
 * String to array test cases.
 */
namespace Kata\Test\StringToArray;

use Kata\StringToArray\StringToArray;

class StringToArrayTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test for string to array.
	 */
	public function testStringToArray()
	{
		$stringToArray = new StringToArray();
		$result        = $stringToArray->convert('a,b,c');

		$this->assertEquals(array('a', 'b', 'c'), $result);
	}

	/**
	 * Test case of wrong input types.
	 *
	 * @param $value
	 *
	 * @dataProvider differentTypeProvider
	 * @expectedException \Exception
	 */
	public function testWrongInputTypes($value)
	{
		$stringToArray = new StringToArray();
		$stringToArray->convert($value);
	}

	/**
	 * Different type provider.
	 *
	 * @return array
	 */
	public function differentTypeProvider()
	{
		return array(
			[1],
			[array()],
			[new \Exception()],
			[null],
		);
	}
}
