<?php

namespace Kata\Legacy;

/**
 * Product data object / value object.
 */
class Product
{
	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $ean;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * Constructor.
	 *
	 * @param int    $id
	 * @param string $ean
	 * @param string $name
	 */
	public function __construct($id, $ean, $name)
	{
		$this->id   = $id;
		$this->ean  = $ean;
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getEan()
	{
		return $this->ean;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
}