<?php

/**
 * Multi line strings to array test cases.
 */

namespace Kata\Test\StringToArray;

use Kata\StringToArray\MultiLineStringToArray;
use Kata\StringToArray\StringToArray;

class MultiLineStringToArrayTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test for multi line string to array.
	 */
	public function testMultiLineStringToArray()
	{
		$multiLineStringToArray = new MultiLineStringToArray(new StringToArray());
		$result                 = $multiLineStringToArray->convert("211,22,35\n10,20,33");

		$this->assertEquals(array(array('211,22,35', '10,20,33'), array('211','22','35','10','20','33')), $result);
	}
}
