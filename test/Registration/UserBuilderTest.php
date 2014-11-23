<?php

/**
 * The user builder test cases.
 */
namespace Kata\Test\Registration;

use Kata\Registration\UserBuilder;
use Kata\Registration\User;

class UserBuilderTest extends \PHPUnit_Framework_TestCase
{
	/** @var UserBuilder */
	protected $userBuilder;

	/**
	 * setUp()
	 */
	public function setUp()
	{
		$this->userBuilder = new UserBuilder();
	}

	/**
	 * @dataProvider providerGetUser
	 */
	public function testGetUser($userName, $password)
	{
		$user = $this->userBuilder->getUser($userName, $password);

		$this->assertEquals($user->getName(), $userName);
		$this->assertEquals($user->getPassword(), $password);
		$this->assertEquals($user->getHashedPassword(), $password . UserBuilder::$salt);
	}

	/**
	 * Test get user data provider.
	 *
	 * @return array
	 */
	public function providerGetUser()
	{
		return array(
			array('bandi', 'jelszo1'),
			array('jozsika', 'jelszo2'),
			array('pistike9', '3jelszo'),
		);
	}
}