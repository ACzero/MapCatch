<?php
$link = mysql_connect('localhost','zhanhui','zhanhui@)!$');
mysql_select_db("mapdata",$link);
mysql_query("SET NAMES UTF8");
function DBclose()
{
	global $link;
	mysql_close($link);
}
?>