<?php

/**
 * The response data object.
 */
namespace Kata\Registration;

class Response
{
	/** @var string   The success. */
	protected $success;
	/** @var string   The result code. */
	protected $resultCode;
	/** @var string   The result id. */
	protected $resultId;

	/**
	 * Constructor.
	 *
	 * @param string $success      The success.
	 * @param string $resultCode   The result code.
	 * @param string $resultId     The result id.
	 */
	public function __construct($success, $resultCode, $resultId)
	{
		$this->success    = $success;
		$this->resultCode = $resultCode;
		$this->resultId   = $resultId;
	}

	/**
	 * @return string
	 */
	public function getSuccess()
	{
		return $this->success;
	}

	/**
	 * @return string
	 */
	public function getResultCode()
	{
		return $this->resultCode;
	}

	/**
	 * @return string
	 */
	public function getResultId()
	{
		return $this->resultId;
	}
}