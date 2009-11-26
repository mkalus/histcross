<?php
/*********************************************************
 * histcross v2.0
 * File: form_dates.php
 * Created: 06.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
?>
<div class="datetime">
<?php echo $form->input('start_time_entry', array('label' => __('Start Date', true))); ?>
	<div class="datetimeboxes">
<?php
	echo $form->input('start_time_ca', array('label' => __('ca', true)));
	echo $form->input('start_time_questionable', array('label' => __('Unclear Date?', true)));
	echo $form->input('start_time_julian', array('label' => __('Julian?', true)));
?>
	</div><div style="clear: left;"></div>
<?php echo $form->input('stop_time_entry', array('label' => __('Stop Date', true))); ?>
	<div class="datetimeboxes">
<?php
	echo $form->input('stop_time_ca', array('label' => __('ca', true)));
	echo $form->input('stop_time_questionable', array('label' => __('Unclear Date?', true)));
	echo $form->input('stop_time_julian', array('label' => __('Julian?', true)));
?>
	</div><div style="clear: left;"></div>
</div>
