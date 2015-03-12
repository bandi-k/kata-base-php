<?php

/**
 * Multi line strings to array test cases.
 */

namespace Kata\Test\StringToArray;

use Kata\StringToArray\MultiLineStringToArray;

class MultiLineStringToArrayTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test for multi line string to array.
	 */
	public function testMultiLineStringToArray()
	{
		$multiLineStringToArray = new MultiLineStringToArray();
		$result                 = $multiLineStringToArray->convert("211,22,35\n10,20,33");

		$this->assertEquals(array('211,22,35', '10,20,33'), $result);
	}
}
