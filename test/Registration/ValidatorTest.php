<?php

/**
 * The registration validator bo test cases.
 */
namespace Kata\Test\Registration;

use Kata\Registration\Validator;
use Kata\Registration\Request;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider providerValidatorSuccess
	 */
	public function testValidatorBoSuccess($request)
	{
		$validator = new Validator($request);

		$this->assertTrue($validator->isValidUserName());
		$this->assertTrue($validator->isValidPassword());
	}

	/**
	 * Validator success data provider.
	 */
	public function providerValidatorSuccess()
	{
		return array(
			array(new Request('bandi', 'jelszo1', 'jelszo1')),
			array(new Request('jozsika', 'jelszo2', 'jelszo2')),
			array(new Request('pistike9', '3jelszo', '3jelszo')),
		);
	}

	/**
	 * @dataProvider providerValidatorUnsuccess
	 * @expectedException \Kata\Registration\InvalidUserNameException
	 */
	public function testInvalidUserNameException($request)
	{
		$validator = new Validator($request);

		$validator->isValidUserName();
	}

	/**
	 * @dataProvider providerValidatorUnsuccess
	 * @expectedException \Kata\Registration\InvalidPasswordException
	 */
	public function testInvalidPasswordException($request)
	{
		$validator = new Validator($request);

		$validator->isValidPassword();
	}

	/**
	 * Validator unsuccess data provider.
	 *
	 * @return array
	 */
	public function providerValidatorUnsuccess()
	{
		return array(
			array(new Request('bandI', 'jelsz', 'jelsz')),
			array(new Request('joz', 'jelszo', 'jelszoo')),
			array(new Request('pistike9kaslashfdkldasjlhfuiwhfbvshagsgvhsfdbvakzugfhasjdgvaskfdzwgaefgshdgjhasgvcjhasdjshdgfasgfzugwfzuqgwfzuqgfzwgfasdfasdfasdfasldkgaasdfasdfsfs', '3jel', 'jelszo')),
		);
	}
}