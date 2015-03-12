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
}
