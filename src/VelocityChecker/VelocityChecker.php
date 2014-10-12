<?php

/**
 * Class VelocityChecker
 */

namespace Kata\VelocityChecker;

class VelocityChecker {

	/**
	 * Checks the captcha is needed ba ip.
	 *
	 * @param $ip
	 *
	 * @return bool   TRUE, if captcha is needed, otherwise FALSE.
	 */
	public function isCaptchaNeededByIp($ip)
	{
		return false;
	}

} 