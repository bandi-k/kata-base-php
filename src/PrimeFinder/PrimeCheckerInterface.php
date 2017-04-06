<?php

namespace Kata\PrimeFinder;

interface PrimeCheckerInterface
{
	/**
	 * @param $number
	 *
	 * @return bool
	 */
	public function isPrime($number);
}