<?php

/**
 * Tdd practice test class.
 */
namespace Kata\Test\Practice;

use Kata\Practice\Practice;

class PracticeTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Practice test.
	 *
	 * @dataProvider practiceProvider
	 */
	public function testPractice($values, $expected)
	{
		$practice = new Practice();
		$result   = $practice->add($values);

		$this->assertEquals($expected, $result);
	}

	/**
	 * @expectedException \Exception
	 * @expectedExceptionMessage wrong value -1
	 */
	public function testException()
	{
		$practice = new Practice();
		$practice->add('-1');
	}

	/**
	 * Values data provider.
	 *
	 * @return array
	 */
	public function practiceProvider()
	{
		return array(
			['', 0],
			[',1', 1],
			['2,,1', 3],
			['1,2,3', 6],
		);
	}
}