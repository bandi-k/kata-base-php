<?php

namespace Kata\PrimeFinder;

class VerySlowPrimeChecker implements PrimeCheckerInterface
{
	/**
	 * @param int $number
	 *
	 * @return bool
	 */
	public function isPrime($number)
	{
		if (1 == $number)
		{
			return false;
		}

		for ($i = 2; $i < $number; ++$i)
		{
			if (0 === $number % $i)
			{
				return false;
			}
		}

		return true;
	}
}