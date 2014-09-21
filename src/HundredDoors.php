<?php

/**
 * Resolves the hundred doors problem.
 */

Namespace Kata;

class HundredDoors
{
	/** @var array   Contains the doors. */
	protected $doors = array();

	/**
	 * Returns the toggled doors.
	 *
	 * @param int $doorCount   The doors' count.
	 *
	 * @return array   The array of toggled doors.
	 */
	public function getDoors($doorCount)
	{
		$this->doors = array_fill(0, $doorCount, true);

		return $this->doors;
	}
}