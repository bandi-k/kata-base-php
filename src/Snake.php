<?php

/**
 * Snake class
 */

namespace Kata;

class Snake
{

	/**
	 * Returns the statistics.
	 *
	 * @param array $values   The array of values.
	 *
	 * @return array   The statistics.
	 */
	public function getStatistics(array $values)
	{
		$min     = $this->getMinimum($values);
		$max     = $this->getMaximum($values);
		$count   = $this->getCount($values);
		$average = $this->getAverage($values);

		return array($min, $max, $count, $average);
	}

	/**
	 * Returns the minimum value.
	 *
	 * @param array $values   The array of values.
	 *
	 * @return int   The minimum value.
	 */
	public function getMinimum(array $values)
	{
		return min($values);
	}

	/**
	 * Returns the maximum value.
	 *
	 * @param array $values   The array of values.
	 *
	 * @return int   The maximum value.
	 */
	public function getMaximum(array $values)
	{
		return max($values);
	}

	/**
	 * Returns the number of elements.
	 *
	 * @param array $values   The array of values.
	 *
	 * @return int   The number of elements.
	 */
	public function getCount(array $values)
	{
		return count($values);
	}

	/**
	 * Returns the average value.
	 *
	 * @param array $values   The array of values.
	 *
	 * @return float   The average value.
	 */
	public function getAverage(array $values)
	{
		return number_format(array_sum($values) / count($values), 6);
	}
}