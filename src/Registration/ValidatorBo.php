<?php

/**
 * Request validator business object.
 */
namespace Kata\Registration;

class ValidatorBo
{
	/** @var RequestDo */
	protected $request;

	public function __construct(RequestDo $request)
	{
		$this->request = $request;
	}

	public function isValidUserName()
	{
		return (bool)preg_match('#^[a-z0-9]{4,128}$#', $this->request->getUserName());
	}

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