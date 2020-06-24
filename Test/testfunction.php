<?php
//require_once (__DIR__.'/../Lib/Utilities.php');

function merge($arr1, $arr2)
{
	$arr = $arr1;

	foreach ($arr2 as $key => $value)
	{
		if (is_array($arr2[$key]))
		{
			$arr[$key] = is_array($arr[$key])?merge($arr[$key], $arr2[$key]):$arr2[$key];
		}
		else
		{
			$arr[$key] = $value;
		}
	}
	return $arr;
}


function merge2($arr1, $arr2)
{
	$ret = $arr1;
	foreach ($arr2 as $key => $value)
	{
		if (is_array($value))
		{
			$ret[$key] = is_array($ret[$key])?merge2($ret[$key], $value):$value;
		}
		else
			$ret[$key] = $value;
	}

	return $ret;
}



$arr1 = array(6=>'a', 2=>array('b'=>'c', 'd'=>'e'));
$arr2 = array(7=>'f', 2=>array('b'=>'c', 'g'=>'h'));


$arr = merge2($arr1, $arr2);


print_r($arr);
print_r($arr1);
print_r($arr2);
