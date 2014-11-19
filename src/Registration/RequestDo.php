<?php

/**
 * Request data object.
 */
namespace Kata\Registration;


class RequestDo
{
	protected $userName;
	protected $password;
	protected $passwordConfirm;

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