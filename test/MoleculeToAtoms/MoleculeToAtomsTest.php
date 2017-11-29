<?php

namespace Kata\Test\MoleculeToAtoms;

use Kata\MoleculeToAtoms\MoleculeToAtoms;
use PHPUnit_Framework_TestCase;

class MoleculeToAtomsTest extends PHPUnit_Framework_TestCase
{
	/** @var MoleculeToAtoms */
	private $subject;

	public function setUp()
	{
		$this->subject = new MoleculeToAtoms();
	}

	/**
	 * @dataProvider moleculeProvider
	 *
	 * @param $molecule
	 * @param $atoms
	 */
	public function test_parse_molecule($molecule, $atoms)
	{
		$this->assertEquals($this->subject->parse_molecule($molecule), $atoms);
	}

	public function moleculeProvider()
	{
		return [
			['H2O', ['H' => 2, 'O' => 1]],
			['B2H6', ['B' => 2, 'H' => 6]],
			['C6H12O6', ['C' => 6, 'H' => 12, 'O' => 6]],
			['Mo(CO)6', ['Mo' => 1, 'C' => 6, 'O' => 6]],
			['Mg(OH)2', ['Mg' => 1, 'O' => 2, 'H' => 2]],
			['Fe(C5H5)2', ['Fe' => 1, 'C' => 10, 'H' => 10]],
			['(C5H5)Fe(CO)2CH3', ['C' => 8, 'H' => 8, 'Fe' => 1, 'O' => 2]],
			['Pd[P(C6H5)3]4', ['C' => 72, 'H' => 60, 'P' => 4, 'Pd' => 1]],
			['K4[ON(SO3)2]2', ['K' => 4, 'S' => 4, 'O' => 14, 'N' => 2]],
			['As2{Be4C5[BCo3(CO2)3]2}4Cu5', ['As' => 2, 'Cu' => 5, 'Be' => 16, 'C' => 44, 'B' => 8, 'Co' => 24, 'O' => 48]],
			['{[Co(NH3)4(OH)2]3Co}(SO4)3', ['Co' => 4, 'H' => 42, 'N' => 12, 'O' => 18, 'S' => 3]],
		];
	}
}