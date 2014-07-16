<?php
$link = mysql_connect('202.38.194.214','zhanhui','zhanhui@)!$');
mysql_select_db("mapdata",$link);
mysql_query("SET NAMES UTF8");
function DBclose()
{
	global $link;
	mysql_close($link);
}
?>