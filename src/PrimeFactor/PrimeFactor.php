<?php

/**
 * Contains the prime related functions.
 */

namespace Kata\PrimeFactor;

class PrimeFactor
{
	/**
	 * Returns prime factors of a number.
	 *
	 * @param int $number   The number.
	 *
	 * @return array   The array of prime factors.
	 */
	function getPrimeFactor($number) {
		$divisor = 2;
		$factors = [];
		while ($number !== 1)
		{
			if ($number % $divisor === 0)
			{
				$factors[] = $divisor;
				$number /= $divisor;
			}
			else
			{
				$divisor++;
			}
		}

		return $factors;
	}

	/**
	 * Returns a number's divisors count.
	 *
	 * @param int $number   The number.
	 *
	 * @return int   The count of divisors.
	 */
	public function getCountOfDivisors($number) {

		$primeFactors = $this->getPrimeFactor($number);

		$primeCounts = array_count_values($primeFactors);
		$divisors    = 1;

		foreach ($primeCounts as $primeCount)
		{
			$divisors *= ++$primeCount;
		}

		return $divisors;
	}

	/**
	 * Decides whether the given number is even or odd.
	 *
	 * @param int $number   The number.
	 *
	 * @return bool   TRUE, if is even, FALSE if is odd.
	 */
	public function isEvenNumber($number)
	{
		if ($number % 2 === 0)
		{
			return true;
		}

		return false;
	}
}