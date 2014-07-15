<?php
function InsertHotSpot($type,$name,$other)
{
	$query = "INSERT INTO hotspots (type,name,other) VALUES ('".$type."','".$name."','"
		.$other."')";
	
	mysql_query($query);
}

function InsertPoints($name,$points)
{
	$query = "SELECT * FROM hotspots WHERE name ='".$name."'";
	$result = mysql_query($query);
	$a_result = mysql_fetch_array($result);

	foreach ($points as $key => $point) {
		InsertEachPoint($a_result['key'],$point->r,$point->w);
	}
}

function InsertEachPoint($tag,$lng,$lat)
{
	$query = "INSERT INTO points (lng,lat,tag) VALUES ('".$lng."','".$lat."','".$tag."')";
	mysql_query($query);
}

function HotSpotExist($name)
{
	$query = "SELECT * FROM hotspots WHERE name = '".$name."'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

	if($row)
		return true;
	else
		return false;
}

function GetAllData()
{
	@$obj->type = "FeatureCollection";

	$query = "SELECT * FROM hotspots";
	$result = mysql_query($query);
	$count = 0;
	while ($eachHotsopt = mysql_fetch_array($result)) 
	{
		@$obj->features[$count]->type = "Feature";
		@$obj->features[$count]->properties->name = $eachHotsopt['name'];

		$query_b = "SELECT * FROM points WHERE tag = '".$eachHotsopt['key']."'";
		$result_b = mysql_query($query_b);
		$p_count = 0;
		while ($eachPoint = mysql_fetch_array($result_b)) 
		{
			@$obj->features[$count]->points[$p_count]->coordinates[0] = $eachPoint['lng'];
			@$obj->features[$count]->points[$p_count]->coordinates[1] = $eachPoint['lat'];
			$p_count++;
		}
		// @$obj->features[$count]->geometry->type = "Point";
		// @$obj->features[$count]->geometry->coordinates[0] = $result['x'];
		// @$obj->features[$count]->geometry->coordinates[1] = $result['y'];
		$count++;
	}

	var_dump($obj);
	file_put_contents('./export.json', json_encode($obj,JSON_UNESCAPED_UNICODE));
}
?>