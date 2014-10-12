<?php

/**
 * Class VelocityChecker
 */

namespace Kata\VelocityChecker;

class VelocityChecker {

	/** The failed login limits. */
	const FAILED_LOGIN_LIMIT_IP = 3;

	/**
	 * Contains the failed attempts.
	 *
	 * @var array
	 */
	protected $failedLogins = array();

	/**
	 * Checks the captcha is needed by ip.
	 *
	 * @param string $ip   The ip address.
	 *
	 * @return bool   TRUE, if captcha is needed, otherwise FALSE.
	 */
	public function isCaptchaNeededByIp($ip)
	{
		if (isset($this->failedLogins[$ip]))
		{
			$this->failedLogins[$ip]++;

			return $this->failedLogins[$ip] >= self::FAILED_LOGIN_LIMIT_IP;
		}

		$this->failedLogins[$ip] = 1;

		return false;
	}

} 