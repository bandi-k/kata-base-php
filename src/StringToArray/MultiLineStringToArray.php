<?php

/**
 * Multi line string to array class.
 */

namespace Kata\StringToArray;

class MultiLineStringToArray
{
	/**
	 * Returns the converted array.
	 *
	 * @param string $values   The string of values.
	 *
	 * @return array   The array of values.
	 */
	public function convert($values)
	{
		$valuesArray = explode("\n", $values);

		return $valuesArray;
	}
}
