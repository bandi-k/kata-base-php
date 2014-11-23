<?php

/**
 * The user builder.
 */
namespace Kata\Registration;

class UserBuilder
{
	/** @var string   The password salt. */
	public static $salt = '';

	/**
	 * Returns the user object.
	 *
	 * @param string $userName   The user's name.
	 * @param string $password   The user's password.
	 *
	 * @return User   The user object.
	 */
	public function getUser($userName, $password)
	{
		return $this->createUser($userName, $password);
	}

	/**
	 * Returns the user object.
	 *
	 * @param string    $userName    The user's name.
	 * @param Generator $generator   The password generator object.
	 *
	 * @return User   The user object.
	 */
	public function getUserWithGeneratedPassword($userName, Generator $generator)
	{
		$password = $generator->getPassword();

		return $this->createUser($userName, $password);
	}

	/**
	 * Creates the user object.
	 *
	 * @param string $userName   The user's name.
	 * @param string $password   The user's password.
	 *
	 * @return User   The user object.
	 */
	protected function createUser($userName, $password)
	{
		return new User($userName, $password, $password . self::$salt);
	}
}