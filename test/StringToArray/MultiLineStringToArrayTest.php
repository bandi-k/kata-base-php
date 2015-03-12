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
	public function testMultiLineStringToArrayWithStub()
	{
		$stringToArray = $this->getMockBuilder('Kata\StringToArray\StringToArray')->getMock();

		$stringToArray
			->expects($this->at(0))
			->method('convert')
			->with("211,22,35")
			->will($this->returnValue(array('211','22','35')));
		$stringToArray
			->expects($this->at(1))
			->method('convert')
			->with("10,20,33")
			->will($this->returnValue(array('10,20,33')));

		$multiLineStringToArray = new MultiLineStringToArray($stringToArray);
		$result                 = $multiLineStringToArray->convert("211,22,35\n10,20,33");

		$this->assertEquals(array(array('211,22,35', '10,20,33'), array('211','22','35','10','20','33')), $result);
	}

	/**
	 * Test for multi line string to array.
	 *
	 * @param string $values          The values string.
	 * @param array  $expectedArray   The expected array.
	 *
	 * @dataProvider inputValuesProvider
	 */
	public function testMultiLineStringToArray($values, $expectedArray)
	{
		$multiLineStringToArray = new MultiLineStringToArray(new StringToArray());
		$result                 = $multiLineStringToArray->convert($values);

		$this->assertEquals($expectedArray, $result);
	}

	/**
	 * Input values provider.
	 *
	 * @return array
	 */
	public function inputValuesProvider()
	{
		return array(
			["211,22,35\n10,20,33", array(array('211,22,35', '10,20,33'), array('211','22','35','10','20','33'))],
			["luxembourg,kennedy,44\nbudapest,expo ter,5-7\ngyors,fo utca,9", array(array('luxembourg,kennedy,44', 'budapest,expo ter,5-7', 'gyors,fo utca,9'), array('luxembourg','kennedy','44','budapest','expo ter','5-7', 'gyors', 'fo utca', '9'))]
		);
	}
}
