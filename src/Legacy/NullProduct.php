<?php

namespace Kata\Legacy;

/**
 * Representing empty product / null product
 */
class NullProduct extends Product
{
	/**
	 * Constructor.
	 *
	 * @param int    $id
	 * @param string $ean
	 * @param string $name
	 */
	public function __construct($id = null, $ean = null, $name = null)
	{
		$this->id   = null;
		$this->ean  = null;
		$this->name = null;
	}
}