<?php

/**
 * The user data access object.
 * Name UserDao cause a mysterious git bug.
 */
namespace Kata\Registration;

class UserDao2
{
	/** The db file name. */
	const REGISTRATION_DATABASE_FILE = '/Registration.db';

	/** @var \PDO   Database resource. */
	private $pdo;

	/**
	 * Constructor.
	 *
	 * @param \PDO $pdo   The db resource.
	 */
	public function __construct(\PDO $pdo = null)
	{
		$this->pdo = ($pdo instanceof \PDO) ? $pdo : $this->getPdo();
	}

	/**
	 * Creates user.
	 *
	 * @param User $user   The user object.
	 *
	 * @return string   The created user id.
	 *
	 * @throws UserExistsException
	 */
	public function create(User $user)
	{
		if (!$this->isUniqueUserName($user->getName()))
		{
			throw new UserExistsException();
		}

		$sql = "
			INSERT INTO users
				(username, password_hash)
			VALUES
				(:_userName, :_passwordHash)
			";

		$sth = $this->pdo->prepare($sql);

		$params = array(
			':_userName'     => $user->getName(),
			':_passwordHash' => $user->getHashedPassword(),
		);

		$sth->execute($params);

		return $user->getName();
	}

	/**
	 * Returns whether is it uniqeu user name.
	 *
	 * @param string $userName   The user name.
	 *
	 * @return bool   True, if is a unique name.
	 */
	protected function isUniqueUserName($userName)
	{
		$sql =
			"SELECT
				username
			FROM
				users
			WHERE
				username = :_userName
				";

		$sth = $this->pdo->prepare($sql);

		$sth->execute(
			array(':_userName' => $userName)
		);

		$result = $sth->fetchColumn(0);

		return empty($result);
	}

	/**
	 * Returns the db resource.
	 *
	 * @return \PDO
	 * @throws \Exception
	 */
	private function getPdo()
	{
		// @codeCoverageIgnoreStart
		try
		{
			$dsn = sprintf("sqlite:%s", __DIR__ . self::REGISTRATION_DATABASE_FILE);
			$pdo = new \PDO($dsn);
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

			return $pdo;
		}
		catch(\Exception $exception)
		{
			throw new \Exception('Could not crate the db source.');
		}
		// @codeCoverageIgnoreEnd
	}
}