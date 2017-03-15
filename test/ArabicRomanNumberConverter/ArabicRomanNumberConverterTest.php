<?php

namespace Kata\Test\ArabicRomanNumberConverter;

use Kata\ArabicRomanNumberConverter\ArabicRomanNumberConverter;

class ArabicRomanNumberConverterTest extends \PHPUnit_Framework_TestCase
{
	/** @var ArabicRomanNumberConverter */
	private $converter;

	/**
	 * Set up.
	 */
	public function setUp()
	{
		$this->converter = new ArabicRomanNumberConverter();
	}

	/**
	 * @dataProvider numberProvider
	 */
	public function testConvert($arabicNumber, $romanNumber)
	{
		$this->assertEquals($romanNumber, $this->converter->convert($arabicNumber));
	}

	/**
	 * @return array
	 */
	public function numberProvider()
	{
		return [
			[1, 'I'],
			[3, 'III'],
			[4, 'IV'],
			[4, 'IV'],
			[5, 'V'],
			[6, 'VI'],
			[9, 'IX'],
			[10, 'X'],
			[12, 'XII'],
			[16, 'XVI'],
			[19, 'XIX'],
			[33, 'XXXIII'],
			[44, 'XLIV'],
			[50, 'L'],
			[59, 'LIX'],
			[71, 'LXXI'],
			[94, 'XCIV'],
			[101, 'CI'],
			[499, 'CDXCIX'],
			[944, 'CMXLIV'],
			[1001, 'MI'],
			[1111, 'MCXI'],
		];
	}
}