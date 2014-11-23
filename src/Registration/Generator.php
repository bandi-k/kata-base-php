<?php

/**
 * The password generator.
 */
namespace Kata\Registration;

class Generator
{
	public function getPassword()
	{
		$length   = rand(8, 16);
		$chars    = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		$password = substr( str_shuffle( $chars ), 0, $length );

		return $password;
	}
}