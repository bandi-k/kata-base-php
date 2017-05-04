<?php

namespace Kata\Spiral;

class Spiral
{
	/** @var array */
	private $field;

	/** @var int */
	private $x;

	/** @var int */
	private $y;

	/** @var bool */
	private $couldStep;

	/** @var int */
	private $fieldMaximum;

	/**
	 * Constructor.
	 *
	 * @param int $fieldLength
	 */
	public function __construct($fieldLength)
	{
		$this->createField($fieldLength);

		$this->fieldMaximum = count($this->field) - 1;

		$this->x = 0;
		$this->y = 0;
	}

	/**
	 * Creates a 2 dimensional array with the given length and fills up with false.
	 *
	 * @param $fieldLength
	 */
	private function createField($fieldLength)
	{
		$filedRow = [];

		for ($y = 0; $y < $fieldLength; ++$y)
		{
			$filedRow[] = false;
		}

		for ($x = 0; $x < $fieldLength; ++$x)
		{
			$this->field[] = $filedRow;
		}
	}

	/**
	 * Recursive method, goes round until we could step on the field.
	 */
	public function goRound()
	{
		$this->goRight();

		if (!$this->couldStep)
		{
			return;
		}

		$this->goDown();

		if (!$this->couldStep)
		{
			return;
		}

		$this->goLeft();

		if (!$this->couldStep)
		{
			return;
		}

		$this->goUp();

		if (!$this->couldStep)
		{
			return;
		}

		$this->goRound();
	}

	/**
	 * Goes right and takes fields as long as can.
	 */
	private function goRight()
	{
		$this->couldStep = false;

		do
		{
			if (empty($this->field[$this->x][$this->y+2]))
			{
				$this->takeTheField();

				if (empty($this->field[$this->x][$this->y+1]))
				{
					$this->couldStep = true;
				}
			}
			else
			{
				$this->takeTheField();
				break;
			}

			++$this->y;
		}
		while ($this->y < $this->fieldMaximum);
	}

	/**
	 * Goes down and takes fields as long as can.
	 */
	private function goDown()
	{
		$this->couldStep = false;

		do
		{
			if (empty($this->field[$this->x+2][$this->y]))
			{
				$this->takeTheField();

				if (empty($this->field[$this->x+1][$this->y]))
				{
					$this->couldStep = true;
				}
			}
			else
			{
				$this->takeTheField();
				break;
			}

			++$this->x;
		}
		while ($this->x < $this->fieldMaximum);
	}

	/**
	 * Goes left and takes fields as long as can.
	 */
	private function goLeft()
	{
		$this->couldStep = false;

		do
		{
			if (empty($this->field[$this->x][$this->y-2]))
			{
				$this->takeTheField();

				if (empty($this->field[$this->x][$this->y-1]))
				{
					$this->couldStep = true;
				}
			}
			else
			{
				$this->takeTheField();
				break;
			}

			--$this->y;
		}
		while ($this->y > 0);
	}

	/**
	 * Goes up and takes fields as long as can.
	 */
	private function goUp()
	{
		$this->couldStep = false;

		do
		{
			if (empty($this->field[$this->x-2][$this->y]))
			{
				$this->takeTheField();

				if (empty($this->field[$this->x-1][$this->y]))
				{
					$this->couldStep = true;
				}
			}
			else
			{
				$this->takeTheField();;
				break;
			}

			--$this->x;
		}
		while ($this->x > 0);
	}

	/**
	 * Takes the current filed.
	 */
	private function takeTheField()
	{
		$this->field[$this->x][$this->y] = true;
	}

	/**
	 * Draws the Spiral2.
	 */
	public function draw()
	{
		foreach ($this->field as $row)
		{
			foreach ($row as $element)
			{
				echo $element ? 3 : 0;
			}

			echo "</br>";
		}

		echo "</br>";
	}
}

$spiral = new Spiral(5);
$spiral->goRound();
$spiral->draw();

$spiral = new Spiral(10);
$spiral->goRound();
$spiral->draw();

$spiral = new Spiral(50);
$spiral->goRound();
$spiral->draw();

$spiral = new Spiral(100);
$spiral->goRound();
$spiral->draw();


