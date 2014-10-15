<?php

/**
 * Class VelocityChecker
 */

namespace Kata\VelocityChecker;

class VelocityChecker {

	/** The failed login limits. */
	const FAILED_LOGIN_LIMIT_IP       = 3;
	const FAILED_LOGIN_LIMIT_IP_RANGE = 5;

	/** The failed login attempts ttl. */
	const FAILED_LOGIN_ATTEMPTS_TTL = 3600;

	/** @var array   Contains the failed login attempts ips. */
	protected $failedLoginsIps      = array();
	/** @var array   Contains the failed login attempts ip ranges. */
	protected $failedLoginsIpRanges = array();

	/**
	 * Decides the captcha is needed by ip.
	 *
	 * @param AttemptDo $attemptDo   The failed login attempt data.
	 *
	 * @return bool   TRUE, if captcha is needed, otherwise FALSE.
	 */
	public function isCaptchaNeededByIp(AttemptDo $attemptDo)
	{
		$this->increaseAttempts($this->failedLoginsIps, $attemptDo);

		return $this->isCaptchaNeeded($this->failedLoginsIps, $attemptDo->getValue(), self::FAILED_LOGIN_LIMIT_IP);
	}

	/**
	 * Decides the captcha is needed by ip range.
	 *
	 * @param AttemptDo $attemptDo   The failed login attempt data.
	 *
	 * @return bool   TRUE, if captcha is needed, otherwise FALSE.
	 */
	public function isCaptchaNeededByIpRange(AttemptDo $attemptDo)
	{
		$this->increaseAttempts($this->failedLoginsIpRanges, $attemptDo);

		return $this->isCaptchaNeeded($this->failedLoginsIpRanges, $attemptDo->getValue(), self::FAILED_LOGIN_LIMIT_IP_RANGE);
	}


	/**
	 * Decides the captcha is needed.
	 *
	 * @param array  $attempts       The attempts array.
	 * @param string $attemptValue   The current attempt value.
	 * @param int    $attemptLimit   The failed attempts limit.
	 *
	 * @return bool
	 */
	protected function isCaptchaNeeded(array $attempts, $attemptValue, $attemptLimit)
	{
		$attemptCount        = 0;
		$attemptValidityTime = time() - self::FAILED_LOGIN_ATTEMPTS_TTL;

		/** @var AttemptDo $attempt */
		foreach ($attempts as $attempt)
		{
			if ($attempt->getValue() !== $attemptValue)
			{
				continue;
			}

			if (
				$attempt->getTime() >= $attemptValidityTime
				&& ++$attemptCount >= $attemptLimit
			) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Increases the failed attempts.
	 *
	 * @param array     &$attempts   The current attempts container.
	 * @param AttemptDo $attemptDo   The failed login attempt data.
	 *
	 * @return void
	 */
	protected function increaseAttempts(array &$attempts, AttemptDo $attemptDo)
	{
		$attempts[] = $attemptDo;
	}
} 