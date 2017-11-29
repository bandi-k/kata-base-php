<?php

namespace Kata\MoleculeToAtoms;

class MoleculeToAtoms
{
	private $parentheses = [
		'(\((?P<molecule>[A-Za-z0-9]+)\)?(?P<multiplier>\d*))',
		'(\[(?P<molecule>[A-Za-z0-9]+)\]?(?P<multiplier>\d*))',
		'(\{(?P<molecule>[A-Za-z0-9]+)\}?(?P<multiplier>\d*))',
	];

	/**
	 * @param string $molecule
	 *
	 * @return array
	 */
	public function parse_molecule($molecule)
	{
		foreach ($this->parentheses as $parenthesis)
		{
			preg_match_all($parenthesis, $molecule, $matches, PREG_SET_ORDER);

			if (empty($matches))
			{
				break;
			}

			foreach ($matches as $matchGroup)
			{
				if (empty($matchGroup['multiplier']))
				{
					// todo bugs-bugs-bugs
					$pos = strpos($molecule, $matchGroup[0]);

					if ($pos !== false)
					{
						$molecule = substr_replace($molecule, $matchGroup['molecule'], $pos, strlen($matchGroup[0]));
					}

					continue;
				}

				preg_match_all('/[A-Z][a-z]*[0-9]*/', $matchGroup['molecule'], $atoms);

				$multipliedAtoms = '';

				foreach ($atoms[0] as $index => $atom)
				{
					if (preg_match('#\d+#', $atom, $atomCount))
					{
						$multipliedAtoms .= str_replace($atomCount[0], $atomCount[0] * $matchGroup['multiplier'], $atom);
					}
					else
					{
						$multipliedAtoms .= $atom . $matchGroup['multiplier'];
					}
				}

				// todo bugs-bugs-bugs
				$molecule = str_replace($matchGroup[0], $multipliedAtoms, $molecule);
			}
		}

		preg_match_all('/(?P<letters>[A-Z][a-z]*)(?P<numbers>\d*)/', $molecule, $elements, PREG_SET_ORDER);

		$final = [];

		foreach ($elements as $element)
		{
			if (isset($final[$element['letters']]))
			{
				$final[$element['letters']] = (int)$final[$element['letters']] + (!empty($element['numbers']) ? (int)$element['numbers'] : 1);
			}
			else
			{
				$final[$element['letters']] = (!empty($element['numbers']) ? (int)$element['numbers'] : 1);
			}
		}

		return $final;
	}
}