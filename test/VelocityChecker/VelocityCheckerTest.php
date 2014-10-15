<?php

namespace Kata\Test\VelocityChecker;

use Kata\VelocityChecker\AttemptDo;
use Kata\VelocityChecker\CaptchaCheckerByIp;
use Kata\VelocityChecker\CaptchaCheckerByIpRange;

class VelocityCheckerTest extends \PHPUnit_Framework_TestCase{

	public function testCheckByIp()
	{
		$captchaCheckerByIp = new CaptchaCheckerByIp();
		$time            = time();

		$attemptDo = new AttemptDo('192.168.0.1', $time);
		$this->assertFalse($captchaCheckerByIp->checkIsCaptchaNeeded($attemptDo));
		$this->assertFalse($captchaCheckerByIp->checkIsCaptchaNeeded($attemptDo));
		$attemptDo = new AttemptDo('192.168.0.1', $time - 3601);
		$this->assertFalse($captchaCheckerByIp->checkIsCaptchaNeeded($attemptDo));
		$attemptDo = new AttemptDo('192.168.0.1', $time - 3600);
		$this->assertTrue($captchaCheckerByIp->checkIsCaptchaNeeded($attemptDo));
		$attemptDo = new AttemptDo('192.168.0.1', $time - 3601);
		$this->assertTrue($captchaCheckerByIp->checkIsCaptchaNeeded($attemptDo));
	}

	public function testCheckByIpRange()
	{
		$captchaCheckerByIpRange = new CaptchaCheckerByIpRange();
		$time            = time();

		$attemptDo = new AttemptDo('192.168.0', $time);
		$this->assertFalse($captchaCheckerByIpRange->checkIsCaptchaNeeded($attemptDo));
		$this->assertFalse($captchaCheckerByIpRange->checkIsCaptchaNeeded($attemptDo));
		$this->assertFalse($captchaCheckerByIpRange->checkIsCaptchaNeeded($attemptDo));
		$this->assertFalse($captchaCheckerByIpRange->checkIsCaptchaNeeded($attemptDo));
		$attemptDo = new AttemptDo('192.168.0', $time - 3601);
		$this->assertFalse($captchaCheckerByIpRange->checkIsCaptchaNeeded($attemptDo));
		$attemptDo = new AttemptDo('192.168.0', $time - 3600);
		$this->assertTrue($captchaCheckerByIpRange->checkIsCaptchaNeeded($attemptDo));
	}

	public function testAttemptDo()
	{
		$attemptDo = new AttemptDo('akarmi', 456789);

		$this->assertEquals('akarmi', $attemptDo->getValue());
		$this->assertEquals(456789, $attemptDo->getTime());
	}
} 