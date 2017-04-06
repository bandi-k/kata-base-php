<?php

namespace Kata\Test\PrimeFinder;

use Kata\PrimeFinder\PrimeFinder;
use Kata\PrimeFinder\VerySlowPrimeChecker;
use PHPUnit_Framework_TestCase;

class PrimeFinderTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @param $prime
	 * @param $number
	 *
	 * @dataProvider primeProvider
	 */
	public function testFindTheBiggestInsideTheNumber($prime, $number)
	{
		$finder = new PrimeFinder(new VerySlowPrimeChecker());

		$this->assertEquals($prime, $finder->findTheBiggestInsideTheNumber($number));
	}

	/**
	 * @return array
	 */
	public function primeProvider()
	{
		return [
			[131, 413122222],
			[0, 444],
			[2131, 2131],
			[0, 1],
		];
	}
}