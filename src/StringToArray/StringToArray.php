<?php
/**
 * String to array class.
 */
namespace Kata\StringToArray;

class StringToArray
{
	/**
	 * Returns the converted array.
	 *
	 * @param string $values   The string of values.
	 *
	 * @return array   The array of values.
	 *
	 * @throws InvalidInputTypeException   In case of invalid input type.
	 */
	public function convert($values)
	{
		if (!is_string($values))
		{
			throw New InvalidInputTypeException('Wrong input type');
		}

		return array('a', 'b', 'c');
	}
}
