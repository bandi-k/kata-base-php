<?php

namespace Kata\Test\Legacy;

use Kata\Legacy\ProductDao;
use Kata\Legacy\Product;
use Kata\Legacy\NullProduct;

class ProductDaoTest extends \PHPUnit_Framework_TestCase
{
	/** The database dsn. */
	const DSN = 'sqlite:./productTest.db';

	/** @var   \PDO The test db resource. */
	protected static $pdo;

	public static function setUpBeforeClass()
	{
		self::$pdo = new \PDO(self::DSN);
		self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		$sql = "CREATE TABLE product (id INTEGER PRIMARY KEY, ean varchar(64) default '', name text default '')";

		self::$pdo->exec($sql);
	}

	public static function tearDownAfterClass()
	{
		self::$pdo->exec("DROP TABLE product");
	}

	/**
	 * Get product by EAN test.
	 *
	 * @return Product
	 */
	public function testGetByEan()
	{
		$sth = self::$pdo->prepare("INSERT INTO product (ean, name) VALUES (:_ean, :_name)");
		$sth->execute(
			array(
				':_ean'  => 'ean1',
				':_name' => 'test product',
			)
		);

		$productDao = new ProductDao(self::$pdo);
		$product    = $productDao->getByEan('ean1');

		//$this->assertInstanceOf('\Product', $product);
		$this->assertEquals('ean1', $product->ean);

		return $product;
	}

	/**
	 * Get product by id test.
	 *
	 * @param Product $product
	 *
	 * @depends testGetByEan
	 */
	public function testGetById(Product $product)
	{
		$productDao = new ProductDao(self::$pdo);
		$product    = $productDao->getById($product->id);

		$this->assertEquals('ean1', $product->ean);
	}
}