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
		$prime = 0;

		for ($numberLength = strlen($number); $numberLength >= 1; --$numberLength)
		{
			$subNumberStart = 0;

			while(1)
			{
				$subNumber = substr($number, $subNumberStart, $numberLength);

				if (strlen($subNumber) < $numberLength)
				{
					break;
				}

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
		}

		return 0;
	}
}