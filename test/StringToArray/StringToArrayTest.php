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
	 *
	 * @param string $values          The values string.
	 * @param array  $expectedArray   The expected array.
	 *
	 * @dataProvider inputValuesProvider
	 */
	public function testStringToArray($values, array $expectedArray)
	{
		$stringToArray = new StringToArray();
		$result        = $stringToArray->convert($values);

		$this->assertEquals($expectedArray, $result);
	}

	/**
	 * Test case of wrong input types.
	 *
	 * @param mixed $value   The input value.
	 *
	 * @dataProvider differentTypeProvider
	 * @expectedException \Kata\StringToArray\InvalidInputTypeException
	 */
	public function testWrongInputTypes($value)
	{
		$stringToArray = new StringToArray();
		$stringToArray->convert($value);
	}

	/**
	 * Input values provider.
	 *
	 * @return array
	 */
	public function inputValuesProvider()
	{
		return array(
			['a,b,c', array('a', 'b', 'c')],
			['100,982,444,990,1', array('100', '982', '444', '990', '1')],
			['Mark,Anthony,marka@lib.de', array('Mark', 'Anthony', 'marka@lib.de')],
			['100,111,aaa,AAA', array('100', '111', 'aaa', 'AAA')],
			['', array('')],
			[',a', array('', 'a')],
		);
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
