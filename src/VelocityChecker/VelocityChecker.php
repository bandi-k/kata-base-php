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
	 * @param string $ip     The ip address.
	 * @param int    $time   The login timestamp.
	 *
	 * @return bool   TRUE, if captcha is needed, otherwise FALSE.
	 */
	public function isCaptchaNeededByIp($ip, $time)
	{
		$this->failedLoginsIps[] = array(
			'value' => $ip,
			'time'  => $time,
		);

		return $this->isCaptchaNeeded($this->failedLoginsIps, $ip, self::FAILED_LOGIN_LIMIT_IP);
	}

	/**
	 * Decides the captcha is needed by ip range.
	 *
	 * @param string $ipRange   The ip address range.
	 * @param int    $time      The login timestamp.
	 *
	 * @return bool   TRUE, if captcha is needed, otherwise FALSE.
	 */
	public function isCaptchaNeededByIpRange($ipRange, $time)
	{
		$this->failedLoginsIpRanges[] = array(
			'value' => $ipRange,
			'time'  => $time,
		);

		return $this->isCaptchaNeeded($this->failedLoginsIpRanges, $ipRange, self::FAILED_LOGIN_LIMIT_IP_RANGE);
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

		foreach ($attempts as $attempt)
		{
			if ($attempt['value'] !== $attemptValue)
			{
				continue;
			}

			if (
				$attempt['time'] >= $attemptValidityTime
				&& ++$attemptCount >= $attemptLimit
			) {
				return true;
			}
		}

		return false;
	}
} 