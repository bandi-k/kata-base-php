<?php

/**
 * Snake class unit test.
 */

namespace Kata\Test;

use Kata\Snake;

class SnakeTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Tests all function of Snake.
	 */
	public function testSnake()
	{
		$values = [6, 9, 15, -2, 92, 11];

		$snake = new Snake();

		$this->assertEquals(-2, $snake->getMinimum($values));
		$this->assertEquals(92, $snake->getMaximum($values));
		$this->assertEquals(6, $snake->getCount($values));
		$this->assertEquals(21.833333, $snake->getAverage($values));

		$this->assertEquals([-2, 92, 6, 21.833333], $snake->getStatistics($values));
	}
}
 