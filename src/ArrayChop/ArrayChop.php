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

		foreach($haystack as $key => $item)
		{
			if ($needle === $item)
			{
				return $key;
			}
		}

		return -1;
	}

	protected function ensureNeedleIsValid($needle)
	{
		//echo is_int($needle) . PHP_EOL;
		if (!is_int($needle))
		{
			throw new InvalidNeedleException();
		}
	}
}