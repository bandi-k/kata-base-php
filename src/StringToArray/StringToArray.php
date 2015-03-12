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
	 */
	public function convert($values)
	{
		$this->validateInputValues($values);

		$array = explode(',', $values);

		return $array;
	}

	/**
	 * Validates the input type.
	 *
	 * @param mixed $values   The input values.
	 *
	 * @throws InvalidInputTypeException   In case of invalid input type.
	 */
	protected function validateInputValues($values)
	{
		if (!is_string($values))
		{
			throw New InvalidInputTypeException('Wrong input type');
		}
	}
}
