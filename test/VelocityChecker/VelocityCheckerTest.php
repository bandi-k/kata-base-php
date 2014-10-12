<?php

namespace Kata\Test\VelocityChecker;

use Kata\VelocityChecker\VelocityChecker;

class VelocityCheckerTest extends \PHPUnit_Framework_TestCase{

	public function testCheckByIp()
	{
		$velocityChecker = new VelocityChecker();

		$this->assertFalse($velocityChecker->isCaptchaNeededByIp('192.168.0.1'));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIp('192.168.0.1'));
		$this->assertTrue($velocityChecker->isCaptchaNeededByIp('192.168.0.1'));
		$this->assertTrue($velocityChecker->isCaptchaNeededByIp('192.168.0.1'));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIp('192.168.0.2'));
		$this->assertFalse($velocityChecker->isCaptchaNeededByIp('192.168.0.2'));
		$this->assertTrue($velocityChecker->isCaptchaNeededByIp('192.168.0.2'));
	}
} 