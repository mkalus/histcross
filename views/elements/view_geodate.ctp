<?php
/*********************************************************
 * histcross v2.0
 * File: view_geodate.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

/**
 * Geo/Date allowed view element
 * $data should be set
 * $model should be set, too
 */

?>
			<dt><?php  __('Show');?></dt>
			<dd>
<?php
	//Create a nice list of shown entries
	$possibleentries = array('show_geo' => 'Geographic Coordinates',
		'show_date' => 'Date Entries');
	$actualentries = array();
	foreach ($possibleentries as $fieldname => $name)
		if ($data[$model][$fieldname] != 0)
			$actualentries[] = __($name, true);
	if (count($actualentries) == 0) __('none');
	else echo implode(', ', $actualentries);
?>
			</dd>
