<?php

namespace Kata\PrimeFinder;

class SlowPrimeChecker implements PrimeCheckerInterface
{
	/**
	 * @param $number
	 *
	 * @return bool
	 */
	public function isPrime($number)
	{
		if($number == 1) return false;

		if($number == 2) return true;

		if($number % 2 == 0) return false;

		$ceil = ceil(sqrt($number));
		for($i = 3; $i <= $ceil; $i = $i + 2)
		{
			if($number % $i == 0) return false;
		}

		return true;
	}
}