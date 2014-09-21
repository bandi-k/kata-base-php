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
		$this->doors = array_fill(0, $doorCount, false);

		$this->toggleDoors($doorCount);


		return $this->doors;
	}

	/**
	 * Toggles the doors.
	 *
	 * @param int $doorCount   The doors' count.
	 *
	 * @return void
	 */
	protected function toggleDoors($doorCount)
	{
		$currentRide   = 1;
		$halfDoorCount = floor($doorCount / 2);

		// We need this on the half of the doors.
		for ($i = 0; $i < $halfDoorCount; ++$i)
		{
			foreach ($this->doors as $doorNumber => $door)
			{
				if (($doorNumber+1) % $currentRide === 0) {
					$this->doors[$doorNumber] = !$this->doors[$doorNumber];
				}
			}

			$currentRide++;
		}

		// We need to toggle the doors over the halfdoors.
		foreach ($this->doors as $doorNumber => $door)
		{
			if (($doorNumber+1) > $halfDoorCount ) {
				$this->doors[$doorNumber] = !$this->doors[$doorNumber];
			}
		}
	}
}