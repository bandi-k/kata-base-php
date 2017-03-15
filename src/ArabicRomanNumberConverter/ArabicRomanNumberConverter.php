<?php

namespace Kata\ArabicRomanNumberConverter;

class ArabicRomanNumberConverter
{
	private $romanDigits = [
		[0 => '', 1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', ],
		[0 => '', 1 => 'X', 2 => 'XX', 3 => 'XXX', 4 => 'XL', 5 => 'L', 6 => 'LX', 7 => 'LXX', 8 => 'LXXX', 9 => 'XC', ],
		[0 => '', 1 => 'C', 2 => 'CC', 3 => 'CCC', 4 => 'CD', 5 => 'D', 6 => 'DC', 7 => 'DCC', 8 => 'DCCC', 9 => 'CM', ],
		[0 => '', 1 => 'M', 2 => 'MM', 3 => 'MMM', 4 => 'Mv', 5 => 'v', 6 => 'vM', 7 => 'vMM', 8 => 'vMMM', 9 => 'vx', ],
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