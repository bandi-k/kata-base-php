<?php

namespace Kata\Test\VelocityChecker;

use Kata\VelocityChecker\AttemptDo;
use Kata\VelocityChecker\CaptchaCheckerByIp;
use Kata\VelocityChecker\CaptchaCheckerByIpRange;
use Kata\VelocityChecker\CaptchaCheckerByCountry;
use Kata\VelocityChecker\CaptchaCheckerByUserName;
use Kata\VelocityChecker\VelocityChecker;

class VelocityCheckerTest extends \PHPUnit_Framework_TestCase{

	public function testVelocityChecker()
	{
		$velocityChecker = new VelocityChecker();
		$time            = time();

		$this->assertFalse($velocityChecker->checkIsCaptchaNeeded('192.168.0.1', '192.168.0', 'hungary', 'bandi', $time));
		$this->assertFalse($velocityChecker->checkIsCaptchaNeeded('192.168.0.1', '192.168.0', 'hungary', 'bandi', $time));
		$this->assertTrue($velocityChecker->checkIsCaptchaNeeded('192.168.0.1', '192.168.0', 'hungary', 'bandi', $time));
	}

	public function testCheckByIp()
	{
		$captchaCheckerByIp = new CaptchaCheckerByIp();
		$time               = time();

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
		$time                    = time();

		$attemptDo = new AttemptDo('192.168.0', $time);
		for ($i = 1; $i < 50; $i++)
		{
			$this->assertFalse($captchaCheckerByIpRange->checkIsCaptchaNeeded($attemptDo));
		}

		$attemptDo = new AttemptDo('192.168.0', $time - 3601);
		$this->assertFalse($captchaCheckerByIpRange->checkIsCaptchaNeeded($attemptDo));
		$attemptDo = new AttemptDo('192.168.0', $time - 3600);
		$this->assertTrue($captchaCheckerByIpRange->checkIsCaptchaNeeded($attemptDo));
	}

	public function testCheckByCountry()
	{
		$captchaCheckerByCountry = new CaptchaCheckerByCountry();
		$time                    = time();

		$attemptDo = new AttemptDo('hungary', $time - 10);
		for ($i = 1; $i < 100; $i++)
		{
			$this->assertFalse($captchaCheckerByCountry->checkIsCaptchaNeeded($attemptDo));
		}

		$attemptDo = new AttemptDo('hungary', $time - 10);
		$this->assertTrue($captchaCheckerByCountry->checkIsCaptchaNeeded($attemptDo));
	}

	public function testCheckByUserName()
	{
		$captchaCheckerByUserName = new CaptchaCheckerByUserName();
		$time                     = time();

		$attemptDo = new AttemptDo('bandi', $time);
		$this->assertFalse($captchaCheckerByUserName->checkIsCaptchaNeeded($attemptDo));
		$this->assertFalse($captchaCheckerByUserName->checkIsCaptchaNeeded($attemptDo));
		$this->assertTrue($captchaCheckerByUserName->checkIsCaptchaNeeded($attemptDo));
	}

	public function testAttemptDo()
	{
		$attemptDo = new AttemptDo('akarmi', 456789);

		$this->assertEquals('akarmi', $attemptDo->getValue());
		$this->assertEquals(456789, $attemptDo->getTime());
	}
} 