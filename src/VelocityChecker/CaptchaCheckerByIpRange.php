<?php
/**
 * Captcha checker by ip range.
 */

namespace Kata\VelocityChecker;

class CaptchaCheckerByIpRange extends CaptchaCheckerAbstract{
	/** The failed login limits. */
	const FAILED_LOGIN_LIMIT_IP_RANGE = 5;

	/** @var array   Contains the failed login attempts ip ranges. */
	protected $failedLoginsIpRanges = array();

	/**
	 * @see parent::checkIsCaptchaNeeded
	 */
	public function checkIsCaptchaNeeded(AttemptDo $attemptDo)
	{
		$this->increaseAttempts($this->failedLoginsIpRanges, $attemptDo);

		return $this->isCaptchaNeeded($this->failedLoginsIpRanges, $attemptDo->getValue(), self::FAILED_LOGIN_LIMIT_IP_RANGE);
	}

} 