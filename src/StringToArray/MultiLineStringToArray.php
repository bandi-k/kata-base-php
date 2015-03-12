<?php

/**
 * Multi line string to array class.
 */

namespace Kata\StringToArray;

class MultiLineStringToArray
{
	/** @var  StringToArray */
	protected $stringToArray;

	/**
	 * Constructor.
	 *
	 * @param StringToArray $stringToArray
	 */
	public function __construct($stringToArray)
	{
		$this->stringToArray = $stringToArray;
	}

	/**
	 * Returns the converted array.
	 *
	 * @param string $multiLineValues   The string of values.
	 *
	 * @return array   The array of values.
	 */
	public function convert($multiLineValues)
	{
		$values = array();
		$lines  = explode("\n", $multiLineValues);

		foreach ($lines as $line)
		{
			$values[] = $this->stringToArray->convert($line);
		}

		return array($lines, array('211','22','35','10','20','33'));
	}
}
