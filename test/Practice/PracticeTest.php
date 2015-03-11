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
	 */
	public function testPractice()
	{
		$practice = new Practice();
		$result   = $practice->add('');

		$this->assertEquals(0, $result);
	}
}