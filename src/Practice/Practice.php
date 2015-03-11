<?php
/**
 * Practice class.
 */
namespace Kata\Practice;

class Practice
{
	/**
	 * Returns the sum of the values
	 *
	 * @param string $values   The number's string.
	 *
	 * @return int   The sum of the given values.
	 */
	public function add($values)
	{
		$sum    = 0;
		$values = preg_split('#[,\n]#', $values);

		foreach ($values as $value)
		{
			$sum += (int)$value;
		}

		return $sum;
	}
}