<?php

namespace Kata\Weather;

class SmallestTemperatureSpreadFinder
{
	public function find()
	{
		$smallestTempSpread = 0;

		$lines = file(__DIR__ . '/../Data/weather.dat');

		foreach ($lines as $lineNumber => $line)
		{
			$line = preg_split('/\s+/', $line);
//todo clean *
			if (!empty($line[2]) && !empty($line[3]) && is_numeric($line[2]) && is_numeric($line[3]))
			{
				$spread = $line[2] - $line[3];

				if (empty($smallestTempSpread) || $spread < $smallestTempSpread)
				{
					$smallestTempSpread = $spread;
				}
			}
		}

		echo 'the smallest spread: ' . $smallestTempSpread;
	}
}

$f = new SmallestTemperatureSpreadFinder();
$f->find();