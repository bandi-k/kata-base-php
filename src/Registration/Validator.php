<?php

/**
 * Request validator business object.
 */
namespace Kata\Registration;

class Validator
{
	/** @var Request */
	protected $request;

	/**
	 * Constructor.
	 *
	 * @param Request $request   The request object.
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Returns whether is valid user name.
	 *
	 * @return bool  True, if is valid user name.
	 */
	public function isValidUserName()
	{
		return (bool)preg_match('#^[a-z0-9]{4,128}$#', $this->request->getUserName());
	}

	/**
	 * Returns whether is valid password.
	 *
	 * @return bool  True, if is valid password.
	 */
	public function isValidPassword()
	{
		$password = $this->request->getPassword();

		if (
			$password !== ''
			&& strlen($password) < 6
		) {
			return false;
		}

		if ($password !== $this->request->getPasswordConfirm())
		{
			return false;
		}

		return true;
	}
}