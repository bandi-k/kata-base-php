<?php
/**
 * Created by PhpStorm.
 * User: bandi
 * Date: 2014.10.15.
 * Time: 22:06
 */

namespace Kata\VelocityChecker;


class CaptchaCheckerByUserName extends CaptchaCheckerAbstract{
	/** The failed login limits. */
	const FAILED_LOGIN_LIMIT_USER_NAME = 3;

	/** @var array   Contains the failed login attempts user names. */
	protected $failedLoginsUserNames = array();

	/**
	 * @see parent::checkIsCaptchaNeeded
	 */
	public function checkIsCaptchaNeeded(AttemptDo $attemptDo)
	{
		$this->increaseAttempts($this->failedLoginsUserNames, $attemptDo);

		return $this->isCaptchaNeeded($this->failedLoginsUserNames, $attemptDo->getValue(), self::FAILED_LOGIN_LIMIT_USER_NAME);
	}
} 