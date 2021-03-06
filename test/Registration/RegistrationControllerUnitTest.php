<?php

/**
 * Registration controller unit test.
 */
namespace Kata\Test\Registration;

use Kata\Registration\InvalidUserNameException;
use Kata\Registration\RegistrationController;
use Kata\Registration\Request;
use Kata\Registration\User;
use Kata\Registration\UserBuilder;

class RegistrationControllerUnitTest extends \PHPUnit_Framework_TestCase
{
	public function testRegistration()
	{
		$request = new Request('bandi', 'jelszo', 'jelszo');
		$user    = new User(
			$request->getUserName(),
			$request->getPassword(),
			$request->getPassword() . UserBuilder::$salt
		);

		$validator =
			$this->getMockBuilder('Kata\Registration\Validator')
			->disableOriginalConstructor()
			->getMock();
		$validator
			->expects($this->once())
			->method('isValidUserName')
			->willReturn(true);
		$validator
			->expects($this->once())
			->method('isValidPassword')
			->willReturn(true);

		$userBuilder = $this->getMock('Kata\Registration\UserBuilder');
		$userBuilder
			->expects($this->once())
			->method('getUser')
			->willReturn($user);

		$userDao = $this->getMock('Kata\Registration\UserDao2');
		$userDao
			->expects($this->once())
			->method('create')
			->willReturn($request->getUserName());

		$controller = new RegistrationController($validator, $userBuilder, $userDao);

		$response = $controller->doRegistration($request);

		$this->assertEquals($response->getSuccess(), 'yes');
		$this->assertEquals($response->getResultCode(), 201);
		$this->assertEquals($response->getResultId(), $request->getUserName());
	}

	public function testRegistrationWithInvalidName()
	{
		$request = new Request('ba', 'jelszo', 'jelszo');

		$validator =
			$this->getMockBuilder('Kata\Registration\Validator')
				->disableOriginalConstructor()
				->getMock();
		$validator
			->expects($this->once())
			->method('isValidUserName')
			->will($this->throwException(new InvalidUserNameException()));

		$userBuilder = $this->getMock('Kata\Registration\UserBuilder');
		$userDao     = $this->getMock('Kata\Registration\UserDao2');

		$controller = new RegistrationController($validator, $userBuilder, $userDao);

		$response = $controller->doRegistration($request);

		$this->assertEquals($response->getSuccess(), 'no');
		$this->assertEquals($response->getResultCode(), 601);
		$this->assertEquals($response->getResultId(), '');
	}
}