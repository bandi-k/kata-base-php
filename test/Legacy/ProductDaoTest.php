<?php

namespace Kata\Test\Legacy;

use Kata\Legacy\ProductDao;
use Kata\Legacy\Product;

class ProductDaoTest extends \PHPUnit_Framework_TestCase
{
	/** The database dsn. */
	const DSN = 'sqlite:./productTest.db';

	/** @var   \PDO The test db resource. */
	protected $pdo;

	public function setUp()
	{
		$this->pdo = new \PDO(self::DSN);
		$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$this->pdo->exec("CREATE TABLE product (id INTEGER PRIMARY KEY, ean varchar(64) default '', name text default '')");
	}

	public function tearDown()
	{
		$this->pdo->exec("DROP TABLE product");
	}

	public function testDb()
	{
		$this->assertTrue(true);
	}
}