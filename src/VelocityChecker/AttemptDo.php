<?php
/**
 * Contains the failed login attempt data.
 */

namespace Kata\VelocityChecker;


class AttemptDo {

	/** @var string   The failed attempt value. */
	protected $value = null;

	/** @var int   The failed login timestamp. */
	protected $time = 0;

	/**
	 * Constructor.
	 *
	 * @param string $value   The failed attempt value.
	 * @param int    $time    The failed login timestamp.
	 */
	public function __construct($value, $time)
	{
		$this->value = $value;
		$this->time  = $time;
	}

	/**
	 * Returns the failed attempt value.
	 *
	 * @return string   The value.
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Returns the failed login timestamp.
	 *
	 * @return int   The timestamp.
	 */
	public function getTime()
	{
		return $this->time;
	}
}