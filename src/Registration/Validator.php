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
	 * @throws InvalidUserNameException
	 */
	public function isValidUserName()
	{
		if ((bool)preg_match('#^[a-z0-9]{4,128}$#', $this->request->getUserName()))
		{
			return true;
		}

		throw new InvalidUserNameException();
	}

	/**
	 * Returns whether is valid password.
	 *
	 * @return bool  True, if is valid password.
	 * @throws InvalidPasswordException();
	 */
	public function isValidPassword()
	{
		$password = $this->request->getPassword();

		if (
			$password !== ''
			&& strlen($password) < 6
		) {
			throw new InvalidPasswordException();
		}

		if ($password !== $this->request->getPasswordConfirm())
		{
			throw new InvalidPasswordException();
		}

		return true;
	}
}