<?php 
function DateInSQL($strIn)
{
	return date("Y-m-d", strtotime($strIn));
	// $day = substr($strIn,0,2);
	// $month = substr($strIn,3,2);
	// $year = substr($strIn,6,4);
	// return "$year-$month-$day";
}

function DateOutSQL($strOut)
{
	return date("d/m/Y", strtotime($strOut));
	// $day = substr($strOut,8,2);
	// $month = substr($strOut,5,2);
	// $year = substr($strOut,0,4);
	// return "$day/$month/$year";
}
?>