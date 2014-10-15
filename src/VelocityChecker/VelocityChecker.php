<?php

/**
 * Class VelocityChecker
 * @todo attempt resources(file?)
 * @todo users resource(file?)
 * @todo attempt factory
 */

namespace Kata\VelocityChecker;

class VelocityChecker {

	/** @var CaptchaCheckerByIp  */
	protected $captchaCheckerByIp       = null;
	/** @var CaptchaCheckerByIpRange  */
	protected $captchaCheckerByIpRange  = null;
	/** @var CaptchaCheckerByCountry  */
	protected $captchaCheckerByCountry  = null;
	/** @var CaptchaCheckerByUserName  */
	protected $captchaCheckerByUserName = null;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->captchaCheckerByIp       = new CaptchaCheckerByIp();
		$this->captchaCheckerByIpRange  = new CaptchaCheckerByIpRange();
		$this->captchaCheckerByCountry  = new CaptchaCheckerByCountry();
		$this->captchaCheckerByUserName = new CaptchaCheckerByUserName();
	}

	/**
	 * Decides is captcha is needed.
	 *
	 * @param string $ip         The attempt ip.
	 * @param string $ipRange    The attempt ip range.
	 * @param string $country    The attempt country.
	 * @param string $userName   The attempt user name.
	 * @param int    $time       The attempt timestamp.
	 *
	 * @return bool   TRUE, if captcha needed, otherwise FALSE.
	 */
	public function checkIsCaptchaNeeded($ip, $ipRange, $country, $userName, $time)
	{
		$attempt = new AttemptDo($ip, $time);

		return $this->captchaCheckerByIp->checkIsCaptchaNeeded($attempt);
	}

} 