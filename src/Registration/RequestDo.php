<?php

/**
 * Request data object.
 */
namespace Kata\Registration;


class RequestDo
{
	/** @var string   The user's name. */
	protected $userName;
	/** @var string   The user's password. */
	protected $password;
	/** @var string   The user's password confirm. */
	protected $passwordConfirm;

	/**
	 * @param string $userName          The user's name.
	 * @param string $password          The user's password.
	 * @param string $passwordConfirm   The user's password confirm.
	 */
	public function __construct($userName, $password = '', $passwordConfirm = '')
	{
		$this->userName        = $userName;
		$this->password        = $password;
		$this->passwordConfirm = $passwordConfirm;
	}

	/**
	 * @return mixed
	 */
	public function getUserName()
	{
		return $this->userName;
	}

	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @return mixed
	 */
	public function getPasswordConfirm()
	{
		return $this->passwordConfirm;
	}
}