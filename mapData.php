<?php
include('./DBLink.php');
include('./DBfunction.php');

$JsonStr = $_POST['data'];
$jsonObj = json_decode($JsonStr);

if(HotSpotExist($jsonObj->name))
{
	return;
}

InsertHotSpot($jsonObj->type,$jsonObj->name,$jsonObj->tucao);
InsertPoints($jsonObj->name,$jsonObj->points);

DBclose();
?>
