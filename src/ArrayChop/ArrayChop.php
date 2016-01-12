<?php

/**
 * Class ArrayChop
 */

namespace Kata\ArrayChop;

class ArrayChop
{
	/**
	 * Returns the index of needle in the haystack or -1 if does not exist.
	 *
	 * @param int   $needle     The needle.
	 * @param array $haystack   the haystack.
	 *
	 * @return int   The index.
	 */
	public function start($needle, array $haystack)
	{
		$this->ensureNeedleIsValid($needle);
		$this->ensureHaystackIsValid($haystack);

		foreach($haystack as $key => $item)
		{
			if ($needle === $item)
			{
				return $key;
			}
		}

		return -1;
	}

	/**
	 * Ensures needle is valid.
	 *
	 * @param int $needle   The needle.
	 *
	 * @return void
	 *
	 * @throws InvalidNeedleException
	 */
	protected function ensureNeedleIsValid($needle)
	{
		if (!is_int($needle))
		{
			throw new InvalidNeedleException();
		}
	}

	/**
	 * Ensures haystack is valid.
	 *
	 * @param array $haystack   The haystack.
	 *
	 * @return void
	 *
	 * @throws InvalidHaystackException
	 */
	protected function ensureHaystackIsValid(array $haystack)
	{
		foreach($haystack as $item)
		{
			if (!is_int($item))
			{
				throw new InvalidHaystackException();
			}
		}
	}
}