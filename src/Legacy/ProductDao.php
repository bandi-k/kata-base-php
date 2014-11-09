<?php

namespace Kata\Legacy;

/**
 * Class ProductDao
 */
class ProductDao {

	/** The db file name. */
	const PRODUCTION_DATABASE_FILE = '/product.db';

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
	 * Get product by EAN.
	 *
	 * @param string $ean   The EAN number.
	 *
	 * @return Product
	 */

	public function getByEan($ean)
	{
		$sth = $this->pdo->prepare("SELECT * FROM product WHERE ean = :ean");
		$sth->execute(
			array(
			':ean' => $ean,
			)
		);

		$rows = $sth->fetchAll();

		return $this->getProduct($rows);
	}

	/**
	 * Get product by id.
	 *
	 * @param int $id   The product id.
	 *
	 * @return Product
	 */
	public function getById($id)
	{
		$sth = $this->pdo->prepare("SELECT * FROM product WHERE id = :id");
		$sth->execute(
			array(
			':id' => $id,
			)
		);

		$rows = $sth->fetchAll();

		return $this->getProduct($rows);
	}

	/**
	 * Create product in database if the EAN is not existing.
	 *
	 * @param Product $product
	 *
	 * @return bool
	 */
	public function create(Product $product)
	{
		if ($this->checkUnique($product->getEan()))
		{
			$sth = $this->pdo->prepare("
			INSERT INTO product
			    (ean, name)
			VALUES
			    (:_ean, :_name)
			");

			return $sth->execute(
				array(
					':_ean'  => $product->getEan(),
					':_name' => $product->getName(),
				)
			);
		}

		return false;
	}

	/**
	 * Modify the product name and ean in database by id.
	 * It checks if the EAN already exists by another product, and does not overwrite.
	 *
	 * @param Product $product
	 * @return bool
	 */
	public function modify(Product $product)
	{
		if ($this->checkUnique($product->getEan()))
		{
			$sth = $this->pdo->prepare("
				UPDATE product
				SET
					ean  = :_ean,
					name = :_name
				WHERE
					id = :_id
			");

			return $sth->execute(
				array(
					':_id'   => $product->getId(),
					':_ean'  => $product->getEan(),
					':_name' => $product->getName(),
				)
			);
		}

		return false;
	}

	/**
	 * Delete product from database
	 *
	 * @param Product $product
	 *
	 * @return bool
	 */
	public function delete(Product $product)
	{
		$sth = $this->pdo->prepare("DELETE FROM product WHERE id = :id");

		return $sth->execute(
			array(
				':id' => $product->getId(),
			)
		);
	}

	/**
	 * Internal PDO getter
	 *
	 * @return \PDO
	 * @throws \Exception
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
		catch(\Exception $exception)
		{
			throw new \Exception('Could not crate the db source.');
		}
	}

	/**
	 * Returns the product object.
	 *
	 * @param array $products   The products.
	 *
	 * @return NullProduct|Product
	 * @throws \Exception
	 */
	private function getProduct(array $products)
	{
		$rowNumber = count($products);

		if (count($products) === 1)
		{
			$product       = $products[0];
			$productObject = new Product($product['id'], $product['ean'], $product['name']);

			return $productObject;
		}
		elseif ($rowNumber > 1)
		{
			throw new \Exception('Db consistency error!');
		}

		return new NullProduct;
	}

	/**
	 * Check if the product will be unique by EAN
	 *
	 * @param $ean
	 *
	 * @return bool
	 */
	private function checkUnique($ean)
	{
		$product = $this->getByEan($ean);

		if ($product instanceof NullProduct)
		{
			return true;
		}

		return false;
	}
}
