<?php

/**
 * User dao test cases.
 */
namespace Kata\Test\Registration;

use Kata\Registration\UserBuilder;
use Kata\Registration\UserDao2;
use Kata\Registration\User;

class UserDaoTest extends \PHPUnit_Framework_TestCase
{
	/** The database dsn. */
	const DSN = 'sqlite:./RegistrationTest.db';

	/** @var \PDO   The db resource. */
	protected static $pdo;

	/** @var UserDao */
	protected $userDao;

	/** setUpBeforeClass() */
	public static function setUpBeforeClass()
	{
		self::$pdo = new \PDO(self::DSN);
		self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		self::$pdo->exec("DROP TABLE IF EXISTS users");

		$sql = "CREATE TABLE users (
			username VARCHAR(128) NOT NULL,
			password_hash VARCHAR(64) NOT NULL,
			PRIMARY KEY(username)
		);";

		self::$pdo->exec($sql);
	}

	/** tearDownAfterClass() */
	public static function tearDownAfterClass()
	{
		self::$pdo->exec("DROP TABLE users");
	}

	/** setUp() */
	public function setUp()
	{
		$this->userDao = new UserDao2(self::$pdo);
	}

	/**
	 * User create test.
	 *
	 * @param User $user
	 * @dataProvider providerCreateUser
	 */
	public function testUserCreate(User $user)
	{
		$userName = $this->userDao->create($user);

		$this->assertEquals($user->getName(), $userName);
	}

	/**
	 * User create test.
	 *
	 * @param User $user
	 * @dataProvider providerCreateUser
	 * @expectedException \Kata\Registration\UserExistsException
	 */
	public function testUserExistsException(User $user)
	{
		$this->userDao->create($user);
	}

	/** Create user data provider. */
	public function providerCreateUser()
	{
		return array(
			array(new User('bandi', 'jelszo', 'jelszo' . UserBuilder::$salt)),
			array(new User('jozsika', 'jelszo2', 'jelszo2' . UserBuilder::$salt)),
		);
	}
}