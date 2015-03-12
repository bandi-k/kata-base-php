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
	 * @expectedException \Exception
	 */
	public function testIntegerInputType()
	{
		$stringToArray = new StringToArray();
		$stringToArray->convert(1);
	}

	/**
	 * @expectedException \Exception
	 */
	public function testArrayInputType()
	{
		$stringToArray = new StringToArray();
		$stringToArray->convert(array(123));
	}
}
