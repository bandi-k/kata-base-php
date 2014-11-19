<?php

/**
 * Request validator business object.
 */
namespace Kata\Registration;

class ValidatorBo
{
	protected $request;

	public function __construct(RequestDo $request)
	{
		$this->request = $request;
	}

	public function isValidUserName()
	{
		return true;
	}

	public function isValidPassword()
	{
		return true;
	}
}