<?php


$field[] = [false, false, false, false, false];
$field[] = [false, false, false, false, false];
$field[] = [false, false, false, false, false];
$field[] = [false, false, false, false, false];
$field[] = [false, false, false, false, false];

$x = $y = 0;

for ($y; $y <= 4; $y++)
{
if (empty($field[$x][$y+2]))
{
$field[$x][$y] = true;
}
else
{
	break;
}
echo $x . $y . " ";
}
echo "<br/>";
for ($x; $x < 4; $x++)
{
	if (empty($field[$x+2][$y]))
	{
		$field[$x][$y] = true;
	}
	else
	{
		break;
	}
	echo $x . $y . "\n";
}

for ($y; $y > 0; $y--)
{
	if (empty($field[$x][$y-2]))
	{
		$field[$x][$y] = true;
	}
	else
	{
		break;
	}
}

for ($y; $x > 0; $x--)
{
	if (empty($field[$x-2][$y]))
	{
		$field[$x][$y] = true;
	}
	else
	{
		break;
	}
}

foreach ($field as $row)
{
	foreach ($row as $element)
	{
		echo (int)$element;
	}

	echo "</br>";
}
exit();

