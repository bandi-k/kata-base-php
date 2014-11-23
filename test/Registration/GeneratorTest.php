<?php
/**
 * The generator test cases.
 */
namespace Kata\Test\Registration;

use Kata\Registration\Generator;


class GeneratorTest extends \PHPUnit_Framework_TestCase
{
	/** @var Generator */
	protected $generator;
	/** @var array   The generated passwords. */
	protected $passwords = array();

	/**
	 * setUp
	 */
	public function setUp()
	{
		$this->generator = new Generator();
	}

	/**
	 * Unique passwords test.
	 */
	public function testGeneratorRandomization()
	{
		$this->loadPasswords(77);

		$this->assertEquals($this->passwords, array_unique($this->passwords));
	}

	/**
	 * Password length test.
	 */
	public function testGeneratorPasswordLength()
	{
		$this->loadPasswords(88);

		foreach ($this->passwords as $password)
		{
			$passwordLength = strlen($password);

			$this->assertTrue($passwordLength > 7, 'Short password error: ' . $password);
			$this->assertTrue($passwordLength < 17, 'Long password error: ' . $password);
		}
	}

	/**
	 * Loads the generated passwords.
	 *
	 * @param int $passwordCount   The desired password count.
	 *
	 * @return void
	 */
	protected function loadPasswords($passwordCount = 10)
	{
		for ($i = 0; $i < $passwordCount; $i++)
		{
			$this->passwords[] = $this->generator->getPassword();
		}
	}
}