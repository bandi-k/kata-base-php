<?php

namespace Kata\Test\VelocityChecker;

use Kata\VelocityChecker\AttemptDo;
use Kata\VelocityChecker\VelocityChecker;

class VelocityCheckerTest extends \PHPUnit_Framework_TestCase{

	public function testCheckByIp()
	{
		$velocityChecker = new VelocityChecker();
		$time            = time();

		$attemptDo = new AttemptDo('192.168.0.1', $time);
		$this->assertFalse($velocityChecker->isCaptchaNeededByIp($attemptDo));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIp($attemptDo));
		$attemptDo = new AttemptDo('192.168.0.1', $time - 3601);
		$this->assertFalse($velocityChecker->isCaptchaNeededByIp($attemptDo));
		$attemptDo = new AttemptDo('192.168.0.1', $time - 3600);
		$this->assertTrue($velocityChecker->isCaptchaNeededByIp($attemptDo));
		$attemptDo = new AttemptDo('192.168.0.1', $time - 3601);
		$this->assertTrue($velocityChecker->isCaptchaNeededByIp($attemptDo));
	}

	public function testCheckByIpRange()
	{
		$velocityChecker = new VelocityChecker();
		$time            = time();

		$attemptDo = new AttemptDo('192.168.0', $time);
		$this->assertFalse($velocityChecker->isCaptchaNeededByIpRange($attemptDo));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIpRange($attemptDo));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIpRange($attemptDo));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIpRange($attemptDo));
		$attemptDo = new AttemptDo('192.168.0', $time - 3601);
		$this->assertFalse($velocityChecker->isCaptchaNeededByIpRange($attemptDo));
		$attemptDo = new AttemptDo('192.168.0', $time - 3600);
		$this->assertTrue($velocityChecker->isCaptchaNeededByIpRange($attemptDo));
	}

	public function testAttemptDo()
	{
		$attemptDo = new AttemptDo('akarmi', 456789);

		$this->assertEquals('akarmi', $attemptDo->getValue());
		$this->assertEquals(456789, $attemptDo->getTime());
	}
} 