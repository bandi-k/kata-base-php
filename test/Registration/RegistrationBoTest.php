<?php

/**
 * Registration test cases.
 */
namespace Kata\Test\Registration;

use Kata\Registration\ValidatorBo;
use Kata\Registration\RequestDo;


class RegistrationTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @dataProvider providerValidatorSuccess
	 */
	public function testValidatorBoSuccess($name, $password, $passwordConfirm)
	{
		$request   = new RequestDo($name, $password, $passwordConfirm);
		$validator = new ValidatorBo($request);

		$this->assertTrue($validator->isValidUserName());
		$this->assertTrue($validator->isValidPassword());
	}

	/**
	 * Validator success data provider.
	 *
	 * @return array
	 */
	public function providerValidatorSuccess()
	{
		return array(
			array('bandi', 'jelszo1', 'jelszo1'),
			array('jozsika', 'jelszo2', 'jelszo2'),
			array('pistike9', '3jelszo', '3jelszo'),
		);
	}

	/**
	 * @dataProvider providerValidatorUnsuccess
	 */
	public function testValidatorBoUnSuccess($name, $password, $passwordConfirm)
	{
		$request   = new RequestDo($name, $password, $passwordConfirm);
		$validator = new ValidatorBo($request);

		$this->assertFalse($validator->isValidUserName());
		$this->assertFalse($validator->isValidPassword());
	}

	/**
	 * Validator unsuccess data provider.
	 *
	 * @return array
	 */
	public function providerValidatorUnsuccess()
	{
		return array(
			array('bandI', 'jelsz', 'jelsz'),
			array('joz', 'jelszo', 'jelszoo'),
			array('pistike9kaslashfdkldasjlhfuiwhfbvshagsgvhsfdbvakzugfhasjdgvaskfdzwgaefgshdgjhasgvcjhasdjshdgfasgfzugwfzuqgwfzuqgfzwgfasdfasdfasdfasldkgaasdfasdfsfs', '3jel', 'jelszo'),

		);
	}
}