<?
//root data set
echo "+++VERTEX+++\n";
echo $root['Vertex']['id']."\n";
echo $root['Vertex']['title']."\n";
echo $hcSupport->dateformatsimple($root['Vertex']['start_time_entry'], $root['Vertex']['start_time_ca'], $root['Vertex']['start_time_questionable'])."\n";
echo $hcSupport->dateformatsimple($root['Vertex']['stop_time_entry'], $root['Vertex']['stop_time_ca'], $root['Vertex']['stop_time_questionable'])."\n";
echo ($root['Vertex']['pictogram_id']==0?$root['VertexType']['pictogram_id']:$root['Vertex']['pictogram_id'])."\n";
echo $root['VertexType']['title']."\n";

//Sort the vertices into list to process information
$vertlist = array($root['Vertex']['id'] => $root['Vertex']['id']);

foreach($root['connections'] as $key => $connection) {
	$vertlist[$key] = $key;
	echo "+++VERTEX+++\n";
	echo $connection['Vertex']['id']."\n";
	echo $connection['Vertex']['title']."\n";
	echo $hcSupport->dateformatsimple($connection['Vertex']['start_time_entry'], $connection['Vertex']['start_time_ca'], $connection['Vertex']['start_time_questionable'])."\n";
	echo $hcSupport->dateformatsimple($connection['Vertex']['stop_time_entry'], $connection['Vertex']['stop_time_ca'], $connection['Vertex']['stop_time_questionable'])."\n";
	echo ($connection['Vertex']['pictogram_id']==0?$connection['VertexType']['pictogram_id']:$connection['Vertex']['pictogram_id'])."\n";
	echo $connection['VertexType']['title']."\n";
}

//now traverse connections
$rellist = array();
foreach($root['connections'] as $connection) {
	//connection from root to children
	$rellist[$connection['id']] = $connection['id'];
	echo "+++RELATION+++\n";
	echo $connection['id']."\n";
	echo $root['Vertex']['id']."\n";
	echo $connection['Vertex']['id']."\n";
	echo $connection['title']."\n";
	echo $connection['pictogram_id']."\n";
	echo $hcSupport->dateformatsimple($connection['start_time_entry'], $connection['start_time_ca'], $connection['start_time_questionable'])."\n";
	echo $hcSupport->dateformatsimple($connection['stop_time_entry'], $connection['stop_time_ca'], $connection['stop_time_questionable'])."\n";

	//subconnections only for interrelations, that have not been added already
	foreach($relations[$connection['Vertex']['id']]['connections'] as $subconnection) {
		if (!array_key_exists($subconnection['id'], $rellist)) {
			$rellist[$subconnection['id']] = $subconnection['id'];
			echo "+++RELATION+++\n";
			echo $subconnection['id']."\n";
			echo $connection['Vertex']['id']."\n";
			echo $subconnection['Vertex']['id']."\n";
			echo $subconnection['title']."\n";
			echo $subconnection['pictogram_id']."\n";
			echo $hcSupport->dateformatsimple($subconnection['start_time_entry'], $subconnection['start_time_ca'], $subconnection['start_time_questionable'])."\n";
			echo $hcSupport->dateformatsimple($subconnection['stop_time_entry'], $subconnection['stop_time_ca'], $subconnection['stop_time_questionable'])."\n";
		}
	}
}
?>
+++END+++
