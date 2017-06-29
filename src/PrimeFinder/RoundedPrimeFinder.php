<?php

namespace Kata\PrimeFinder;

class RoundedPrimeFinder
{
	/** @var PrimeCheckerInterface */
	private $primeChecker;

	/**
	 * @param PrimeCheckerInterface $primeChecker
	 */
	public function __construct(PrimeCheckerInterface $primeChecker)
	{
		$this->primeChecker = $primeChecker;
	}

	/**
	 * @param $max
	 *
	 * @return array
	 */
	public function collectRoundedPrimes($max)
	{
		$foundedPrimes = [];
		$roundedPrimes = [];

		for ($number = 1; $number <= $max; ++$number)
		{
			if (in_array($number, $foundedPrimes))
			{
				continue;
			}

			if ($this->primeChecker->isPrime($number))
			{
				$permutations = $this->getPermutations($number);

				$allPrime = true;

				foreach ($permutations as $key => $item)
				{
					if ($key === 0) continue;

					if (!$this->primeChecker->isPrime($item))
					{
						$allPrime = false;
						break;
					}
				}

				if ($allPrime)
				{
					$foundedPrimes   = array_merge($foundedPrimes, $permutations);
					$roundedPrimes[] = $permutations;

					echo var_export($permutations, true) . PHP_EOL;

				}
			}
		}

		echo 'count: ' . count($roundedPrimes);

		return $roundedPrimes;
	}

	/**
	 * @param int $number
	 *
	 * @return array
	 */
	private function getPermutations($number)
	{
		$permutations = [$number];

		while (count($permutations) < strlen((string)$number))
		{
			$splitted = str_split($number);

			$splitted[] = $splitted[0];

			unset($splitted[0]);

			$number         = implode('', $splitted);
			$permutations[] = (int)$number;
		}

		return $permutations;
	}
}

require dirname(__DIR__) . '/../vendor/autoload.php';

$a = new RoundedPrimeFinder(new SlowPrimeChecker());
$a->collectRoundedPrimes(1000000);