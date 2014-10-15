<?php
/**
 * Captcha checker by country.
 */

namespace Kata\VelocityChecker;


class CaptchaCheckerByCountry extends CaptchaCheckerAbstract{
	/** The failed login limits. */
	const FAILED_LOGIN_LIMIT_COUNTRY = 100;

	/** @var array   Contains the failed login attempts countries. */
	protected $failedLoginsCountries = array();

	/**
	 * @see parent::checkIsCaptchaNeeded
	 */
	public function checkIsCaptchaNeeded(AttemptDo $attemptDo)
	{
		$this->increaseAttempts($this->failedLoginsCountries, $attemptDo);

		return $this->isCaptchaNeeded($this->failedLoginsCountries, $attemptDo->getValue(), self::FAILED_LOGIN_LIMIT_COUNTRY);
	}
} 