<?php
/**
 * Captcha checker by ip.
 */

namespace Kata\VelocityChecker;

class CaptchaCheckerByIp extends CaptchaCheckerAbstract {
	/** The failed login limits. */
	const FAILED_LOGIN_LIMIT_IP = 3;

	/** @var array   Contains the failed login attempts ips. */
	protected $failedLoginsIps = array();

	/**
	 * @see parent::checkIsCaptchaNeeded
	 */
	public function checkIsCaptchaNeeded(AttemptDo $attemptDo)
	{
		$this->increaseAttempts($this->failedLoginsIps, $attemptDo);

		return $this->isCaptchaNeeded($this->failedLoginsIps, $attemptDo->getValue(), self::FAILED_LOGIN_LIMIT_IP);
	}
} 