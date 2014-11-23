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
		$user = new User($userName, $password, $password . self::$salt);

		return $user;
	}
}