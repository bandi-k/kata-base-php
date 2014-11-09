<?php

namespace Kata\Legacy;
use SebastianBergmann\Exporter\Exception;

/**
 * Class ProductDao
 */
class ProductDao {

	const PRODUCTION_DATABASE_FILE = '/product.db';

	/**
	 * @var \PDO Database resource.
	 */
	private $pdo;

	/**
	 * Constructor.
	 *
	 * @param \PDO $pdo   The db resource.
	 */
	public function __construct(\PDO $pdo = null)
	{
		if ($pdo instanceof \PDO)
		{
			$this->pdo = $pdo;
		}
		else
		{
			$this->pdo = $this->getPdo();
		}
	}

	/**
	 * Get product by EAN.
	 *
	 * @param $ean
	 * @return NullProduct|Product
	 */

	public function getByEan($ean)
	{
		$sth = $this->pdo->prepare("SELECT * FROM product WHERE ean = :ean");
		$sth->execute(
			array(
			':ean' => $ean,
			)
		);

		$result = $sth->fetchAll();

		if (!empty($result))
		{
			$product       = new Product;
			$product->id   = $result[0]['id'];
			$product->name = $result[0]['name'];
			$product->ean  = $result[0]['ean'];

			return $product;
		}

		return new NullProduct;
	}

	/**
	 * Get product by id.
	 *
	 * @param $id
	 * @return NullProduct|Product
	 */
	public static function getById($id)
	{
		$sth = self::getPdo()->prepare("SELECT * FROM product WHERE id = :id");
		$sth->execute(
			array(
			':id' => $id,
			)
		);

		$rows = $sth->fetchAll();
		if (count($rows) > 0)
		{
			$row = $rows[0];

			$product = new Product;
			$product->id = $row['id'];
			$product->name = $row['name'];
			$product->ean = $row['ean'];

			return $product;
		}

		return new NullProduct;
	}
	/**
	 * Create product in database if the EAN is not existing.
	 *
	 * @param Product $product
	 * @return bool
	 */
	public static function create(Product $product)
	{
		if (self::checkUnique($product->ean))
		{
			$sth = self::getPdo()->prepare("
			INSERT INTO product
			    (ean, name)
			VALUES
			    (:ean, :name)
			");

			$sth->execute(
			array(
				':ean' => $product->ean,
				':name' => $product->name,
			)
			);
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Modify the product name and ean in database by id.
	 * It checks if the EAN already exists by another product, and does not overwrite.
	 *
	 * @param Product $product
	 * @return bool
	 */
	public static function modify(Product $product)
	{
	if (self::checkUnique($product->ean))
	{
		$sth = self::getPdo()->prepare("
			UPDATE product
			SET
				ean = :ean,
				name = :name
			WHERE id = :id
		");

			$sth->execute(
				array(
					':id'   => $product->id,
					':ean'  => $product->ean,
					':name' => $product->name,
				)
			);
		}
		return true;
	}

	/**
	 * Delete product from database
	 *
	 * @param Product $product
	 * @return bool
	 */
	public static function delete(Product $product)
	{
		$sth = self::getPdo()->prepare("DELETE FROM product WHERE id = :id");

		$sth->execute(
			array(
			':id' => $product->id,
			)
		);

		return true;
	}

	/**
	 * Internal PDO getter
	 *
	 * @return \PDO
	 * @throws Exception
	 */
	private function getPdo()
	{
		try
		{
			$dsn = sprintf("sqlite:%s", __DIR__ . self::PRODUCTION_DATABASE_FILE);
			$pdo = new \PDO($dsn);
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

			return $pdo;
		}
		catch(Exception $exception)
		{
			throw new Exception('Could not crate the db source.');
		}
	}

	/**
	 * Check if the product will be unique by EAN
	 *
	 * @param $ean
	 * @return bool
	 */
	private static function checkUnique($ean)
	{
		$sth = self::getPdo()->prepare("SELECT COUNT(1) FROM product WHERE ean = :ean");
		$sth->execute(
			array(
			':ean' => $ean,
			)
		);

		$countRow = $sth->fetch();
		if ($countRow[0] > 0)
		{
			return false;
		}

		return true;
	}
}
