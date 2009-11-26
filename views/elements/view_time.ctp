<?php
/*********************************************************
 * histcross v2.0
 * File: view_time.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

/**
 * Time view element
 * $data should be set
 * $model should be set, too
 */

//prepare time
$showtime = false;
if ($data[$model]['start_time_entry'] != '') {
	$starttime = $hcSupport->dateformat($data[$model]['start_time_entry'],
		$data[$model]['start_time_ca'],
		$data[$model]['start_time_questionable'],
		$data[$model]['start_time_julian'],
		$data[$model]['start_time']);
	$showtime = true;
} else $starttime = '';
if ($data[$model]['stop_time_entry'] != '') {
	$stoptime = $hcSupport->dateformat($data[$model]['stop_time_entry'],
		$data[$model]['stop_time_ca'],
		$data[$model]['stop_time_questionable'],
		$data[$model]['stop_time_julian'],
		$data[$model]['stop_time']);
	$showtime = true;
} else $stoptime = '';
?>
<?php if ($showtime) : ?>
			<dt class="time"><?php  __('Time');?></dt>
			<dd class="time"><?php echo $starttime; ?> &mdash; <?php echo $stoptime; ?></dd>
<?php endif ?>
