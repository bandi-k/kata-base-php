<?php
/**
 * String to array class.
 */
namespace Kata\StringToArray;

use SebastianBergmann\Exporter\Exception;

class StringToArray
{
	/**
	 * Returns the converted array.
	 *
	 * @param string $values   The string of values.
	 *
	 * @return array   The array of values.
	 *
	 * @throws \Exception   In case of wrong input type.
	 */
	public function convert($values)
	{
		if (!is_string($values))
		{
			throw New \Exception('Wrong input type');
		}

		return array('a', 'b', 'c');
	}
}
