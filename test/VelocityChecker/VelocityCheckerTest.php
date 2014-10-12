<?php

namespace Kata\Test\VelocityChecker;

use Kata\VelocityChecker\VelocityChecker;

class VelocityCheckerTest extends \PHPUnit_Framework_TestCase{

	public function testCheckByIp()
	{
		$velocityChecker = new VelocityChecker();
		$time            = time();

		$this->assertFalse($velocityChecker->isCaptchaNeededByIp('192.168.0.1', $time));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIp('192.168.0.1', $time));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIp('192.168.0.1', $time - 7000));
		$this->assertTrue($velocityChecker->isCaptchaNeededByIp('192.168.0.1', $time - 2000));

		$this->assertFalse($velocityChecker->isCaptchaNeededByIp('192.168.0.2', $time));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIp('192.168.0.2', $time));
		$this->assertTrue($velocityChecker->isCaptchaNeededByIp('192.168.0.2', $time));
	}

	public function testCheckByIpRange()
	{
		$velocityChecker = new VelocityChecker();
		$time            = time();

		$this->assertFalse($velocityChecker->isCaptchaNeededByIpRange('192.168.0', $time));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIpRange('192.168.0', $time));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIpRange('192.168.0', $time));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIpRange('192.168.0', $time));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIpRange('192.168.0', $time - 3601));
		$this->assertTrue($velocityChecker->isCaptchaNeededByIpRange('192.168.0', $time - 3600));
	}
} 