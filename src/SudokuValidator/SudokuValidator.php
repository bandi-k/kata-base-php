<?php

namespace Kata\SudokuValidator;

class SudokuValidator
{
	/**
	 * @param array $solution
	 *
	 * @return bool
	 */
	public function validateSolution(array $solution)
	{
		return
			$this->validateHorizontalLines($solution)
			&& $this->validateVerticalLines($solution)
			&& $this->validateBlocks($solution);
	}

	/**
	 * @param array $solution
	 *
	 * @return bool
	 */
	private function validateHorizontalLines(array $solution)
	{
		foreach ($solution as $line)
		{
			if (!$this->validateNineField($line))
			{
				return false;
			}
		}

		return true;
	}

	/**
	 * @param array $fields
	 *
	 * @return bool
	 */
	private function validateNineField(array $fields)
	{
		$validFields = [1,2,3,4,5,6,7,8,9];

		return empty(array_diff($validFields, $fields));
	}

	/**
	 * @param array $solution
	 *
	 * @return bool
	 */
	private function validateVerticalLines(array $solution)
	{
		$solution = $this->rotate90Degrees($solution);

		return $this->validateHorizontalLines($solution);
	}

	/**
	 * @param array $solution
	 *
	 * @return array
	 */
	private function rotate90Degrees(array $solution)
	{
		$result = [];

		while(count($solution)>0)
		{
			$result[count($solution[0])-1][] = array_shift($solution[0]);

			if (count($solution[0]) == 0)
			{
				array_shift($solution);
			}
		}

		return $result;
	}

	/**
	 * @param array $solution
	 *
	 * @return bool
	 */
	private function validateBlocks(array $solution)
	{
		for ($g = 0; $g <= 8; $g = $g + 3)
		{
			for ($h = 0; $h <= 8; $h = $h + 3)
			{
				$block = [];

				for ($i = 0 + $g; $i <= 2 + $g; ++$i)
				{
					for ($j = 0 + $h; $j <= 2 + $h; ++$j)
					{
						$block[] = $solution[$i][$j];
					}
				}

				if (!$this->validateNineField($block))
				{
					return false;
				}
			}
		}

		return true;
	}
}