<?php

namespace Kata\Legacy;

/**
 * Class ProductDao
 */
class ProductDao {
	/**
	 * @var \PDO Database resource.
	 */
	private static $pdo;


	/**
	 * Get product by EAN.
	 *
	 * @param $ean
	 * @return NullProduct|Product
	 */

	public static function getByEan($ean)
	{
		$sth = self::getPdo()->prepare("SELECT * FROM product WHERE ean = :ean");
		$sth->execute(
			array(
			':ean' => $ean,
			)
		);

		$rows = $sth->fetchAll();
		if (count($rows) > 0)
		{
			$row = $rows[0];

			$product       = new Product;
			$product->id   = $row['id'];
			$product->name = $row['name'];
			$product->ean  = $row['ean'];

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
					':id' => $product->id,
					':ean' => $product->ean,
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
	 */
	private static function getPdo()
	{
		if (!(self::$pdo !== null && self::$pdo instanceof \PDO))
		{
			$dsn = sprintf("sqlite:%s", PRODUCTION_DATABASE_FILE);
			self::$pdo = new \PDO($dsn);
			self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		return self::$pdo;
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
