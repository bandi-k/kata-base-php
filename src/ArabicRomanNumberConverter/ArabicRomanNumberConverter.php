<?php

namespace Kata\ArabicRomanNumberConverter;

class ArabicRomanNumberConverter
{
	/** @var array */
	private $romanDigits = [
		['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'],
		['', 'X', 'XX', 'XXX', 'XL', 'L', 'LX', 'LXX', 'LXXX', 'XC'],
		['', 'C', 'CC', 'CCC', 'CD', 'D', 'DC', 'DCC', 'DCCC', 'CM'],
		['', 'M', 'MM', 'MMM', 'Mv', 'v', 'vM', 'vMM', 'vMMM', 'Mx'],
	];

	/**
	 * @param int $arabicNumber
	 *
	 * @return string
	 */
	public function convert($arabicNumber)
	{
		$arabicNumbers = array_reverse(str_split($arabicNumber));
		$romanNumber   = '';

		foreach ($arabicNumbers as $key => $number)
		{
			$romanNumber = $this->romanDigits[$key][$number] . $romanNumber;
		}

		return $romanNumber;
	}
}
