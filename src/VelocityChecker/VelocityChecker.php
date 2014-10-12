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
	 * Checks the captcha is needed by ip.
	 *
	 * @param string $ip     The ip address.
	 * @param int    $time   The login timestamp.
	 *
	 * @return bool   TRUE, if captcha is needed, otherwise FALSE.
	 */
	public function isCaptchaNeededByIp($ip, $time)
	{
		$this->failedLoginsIps[] = array(
			'ip'   => $ip,
			'time' => $time,
		);

		$attemptCount        = 0;
		$attemptValidityTime = time() - self::FAILED_LOGIN_ATTEMPTS_TTL;

		foreach ($this->failedLoginsIps as $attempt)
		{
			if ($attempt['ip'] !== $ip)
			{
				continue;
			}

			if (
				$attempt['time'] >= $attemptValidityTime
				&& ++$attemptCount >= self::FAILED_LOGIN_LIMIT_IP
			) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Checks the captcha is needed by ip range.
	 *
	 * @param string $ipRange   The ip address range.
	 * @param int    $time      The login timestamp.
	 *
	 * @return bool   TRUE, if captcha is needed, otherwise FALSE.
	 */
	public function isCaptchaNeededByIpRange($ipRange, $time)
	{
		$this->failedLoginsIpRanges[] = array(
			'ip_range' => $ipRange,
			'time'     => $time,
		);

		$attemptCount        = 0;
		$attemptValidityTime = time() - self::FAILED_LOGIN_ATTEMPTS_TTL;

		foreach ($this->failedLoginsIpRanges as $attempt)
		{
			if ($attempt['ip_range'] !== $ipRange)
			{
				continue;
			}

			if (
				$attempt['time'] >= $attemptValidityTime
				&& ++$attemptCount >= self::FAILED_LOGIN_LIMIT_IP_RANGE
			) {
				return true;
			}
		}

		return false;
	}
} 