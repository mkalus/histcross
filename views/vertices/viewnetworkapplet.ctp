<?
$hostname = (env('HTTPS')?'https':'http').'://'.env('HTTP_HOST').substr(env('SCRIPT_NAME'), 0, -9);
?>
<applet code="org.histcross.radar.Radar" archive="/files/HistcrossRadar.jar" width="720" height="720">
	<param name="id" value="<? echo $vertex['Vertex']['id']; ?>" />
	<param name="siteUrl" value="<? echo $hostname; ?>" />
</applet>
