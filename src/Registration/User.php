<?php

/**
 * The user data object.
 */
namespace Kata\Registration;

class User
{
	/** @var  string   The name. */
	protected $name;
	/** @var  string   The hashed password. */
	protected $password;
	/** @var  string   The hashed password. */
	protected $hashedPassword;

	/**
	 * Constructor.
	 *
	 * @param string $name            The name.
	 * @param string $password        The hashed password.
	 * @param string $hashedPassword  The hashed password.
	 */
	public function __construct($name, $password, $hashedPassword)
	{
		$this->name           = $name;
		$this->password       = $password;
		$this->hashedPassword = $hashedPassword;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @return string
	 */
	public function getHashedPassword()
	{
		return $this->hashedPassword;
	}
}