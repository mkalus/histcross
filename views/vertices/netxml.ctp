<?
$hostname = (env('HTTPS')?'https':'http').'://'.env('HTTP_HOST').substr(env('SCRIPT_NAME'), 0, -9);
?>
<histcross:netxml xmlns:histcross="http://www.histcross.org/netxml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="<? echo $hostname; ?>files/netxml.xsd">
  <histcross:rootvertex id="<? echo $root['Vertex']['id']; ?>" title="<? echo $root['Vertex']['title']; ?>" start="<? echo $hcSupport->dateformatsimple($root['Vertex']['start_time_entry'], $root['Vertex']['start_time_ca'], $root['Vertex']['start_time_questionable']); ?>" stop="<? echo $hcSupport->dateformatsimple($root['Vertex']['stop_time_entry'], $root['Vertex']['stop_time_ca'], $root['Vertex']['stop_time_questionable']); ?>" pictogram_id="<? echo $root['Vertex']['pictogram_id']==0?$root['VertexType']['pictogram_id']:$root['Vertex']['pictogram_id']; ?>" vertex_type="<? echo $root['VertexType']['title']; ?>">
<? foreach($root['connections'] as $connection): ?>
  	<histcross:relation  id="<? echo $connection['id']; ?>" title="<? echo $connection['title']; ?>" pictogram_id="<? echo $connection['pictogram_id']; ?>" start="<? echo $hcSupport->dateformatsimple($connection['start_time_entry'], $connection['start_time_ca'], $connection['start_time_questionable']); ?>" stop="<? echo $hcSupport->dateformatsimple($connection['stop_time_entry'], $connection['stop_time_ca'], $connection['stop_time_questionable']); ?>">
  		<histcross:vertex id="<? echo $connection['Vertex']['id']; ?>" title="<? echo $connection['Vertex']['title']; ?>" start="<? echo $hcSupport->dateformatsimple($connection['Vertex']['start_time_entry'], $connection['Vertex']['start_time_ca'], $connection['Vertex']['start_time_questionable']); ?>" stop="<? echo $hcSupport->dateformatsimple($connection['Vertex']['stop_time_entry'], $connection['Vertex']['stop_time_ca'], $connection['Vertex']['stop_time_questionable']); ?>" pictogram_id="<? echo $connection['Vertex']['pictogram_id']==0?$connection['VertexType']['pictogram_id']:$connection['Vertex']['pictogram_id']; ?>" vertex_type="<? echo $connection['VertexType']['title']; ?>" />
<? 
foreach($relations[$connection['Vertex']['id']]['connections'] as $subconnection): ?>
  		<histcross:relation  id="<? echo $subconnection['id']; ?>" title="<? echo $subconnection['title']; ?>" pictogram_id="<? echo $subconnection['pictogram_id']; ?>" start="<? echo $hcSupport->dateformatsimple($subconnection['start_time_entry'], $subconnection['start_time_ca'], $subconnection['start_time_questionable']); ?>" stop="<? echo $hcSupport->dateformatsimple($subconnection['stop_time_entry'], $subconnection['stop_time_ca'], $subconnection['stop_time_questionable']); ?>">
  			<histcross:vertex id="<? echo $subconnection['Vertex']['id']; ?>" title="<? echo $subconnection['Vertex']['title']; ?>" start="<? echo $hcSupport->dateformatsimple($subconnection['Vertex']['start_time_entry'], $subconnection['Vertex']['start_time_ca'], $subconnection['Vertex']['start_time_questionable']); ?>" stop="<? echo $hcSupport->dateformatsimple($subconnection['Vertex']['stop_time_entry'], $subconnection['Vertex']['stop_time_ca'], $subconnection['Vertex']['stop_time_questionable']); ?>" pictogram_id="<? echo $subconnection['Vertex']['pictogram_id']==0?$subconnection['VertexType']['pictogram_id']:$subconnection['Vertex']['pictogram_id']; ?>" vertex_type="<? echo $connection['VertexType']['title']; ?>" />
  		</histcross:relation>
<? endforeach; ?>
  	</histcross:relation>
<? endforeach; ?>
  </histcross:rootvertex>
</histcross:netxml>
