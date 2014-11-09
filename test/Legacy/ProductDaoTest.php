<?php

namespace Kata\Test\Legacy;

use Kata\Legacy\NullProduct;
use Kata\Legacy\ProductDao;
use Kata\Legacy\Product;

class ProductDaoTest extends \PHPUnit_Framework_TestCase
{
	/** The database dsn. */
	const DSN = 'sqlite:./productTest.db';

	/** @var \PDO   The test db resource. */
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

		$this->assertInstanceOf('Kata\Legacy\Product', $product);
		$this->assertEquals('ean1', $product->getEan());

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
		$product    = $productDao->getById($product->getId());

		$this->assertEquals('ean1', $product->getEan());
	}

	/**
	 * Get nullProduct by id test.
	 */
	public function testGetNullProductById()
	{
		$productDao = new ProductDao(self::$pdo);
		$product    = $productDao->getById(0);

		$this->assertInstanceOf('Kata\Legacy\NullProduct', $product);
	}

	/**
	 * Create product test.
	 *
	 * @return Product
	 */
	public function testCreateProduct()
	{
		$product = new Product(null, 'ean2', 'test222');

		$productDao = new ProductDao(self::$pdo);
		$this->assertTrue($productDao->create($product));
		$this->assertFalse($productDao->create($product));

		$resultProduct = $productDao->getByEan('ean2');

		$this->assertEquals($product->getName(), $resultProduct->getName());

		return $resultProduct;
	}

	/**
	 * Modify product test.
	 *
	 * @param Product $product
	 *
	 * @return Product
	 *
	 * @depends testCreateProduct
	 */
	public function testModifyProduct(Product $product)
	{
		$modifiedProduct = new Product($product->getId(), 'modifiedEan', 'modifiedName');

		$productDao = new ProductDao(self::$pdo);
		$this->assertTrue($productDao->modify($modifiedProduct));

		$resultProduct = $productDao->getByEan('modifiedEan');

		$this->assertEquals($modifiedProduct, $resultProduct);

		return $resultProduct;
	}

	/**
	 * Delete product test.
	 *
	 * @param Product $product
	 *
	 * @depends testCreateProduct
	 */
	public function testDeleteProduct(Product $product)
	{
		$productDao = new ProductDao(self::$pdo);
		$this->assertTrue($productDao->delete($product));

		$resultProduct = $productDao->getById($product->getId());

		$this->assertInstanceOf('Kata\Legacy\NullProduct', $resultProduct);
	}
}