<?php

namespace Kata\PrimeFinder;

class PrimeFinder
{
	/** @var PrimeCheckerInterface */
	private $checker;

	/**
	 * @param PrimeCheckerInterface $checker
	 */
	public function __construct(PrimeCheckerInterface $checker)
	{
		$this->checker = $checker;
	}

	/**
	 * @param int $number
	 *
	 * @return int
	 */
	public function findTheBiggestInsideTheNumber($number)
	{
		$shiftCounter = 1;
		$prime        = 0;

		for ($numberLength = strlen($number); $numberLength >= 1; --$numberLength)
		{
			$subNumberStart = 0;

			for ($i = 1; $i <= $shiftCounter; ++$i)
			{
				$subNumber = substr($number, $subNumberStart, $numberLength);

				if ($this->checker->isPrime($subNumber))
				{
					if ($subNumber > $prime)
					{
						$prime = $subNumber;
					}
				}

				++$subNumberStart;
			}

			if ($prime !== 0)
			{
				return $prime;
			}

			++$shiftCounter;
		}

		return 0;
	}
}