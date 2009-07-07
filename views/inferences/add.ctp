<?
/*********************************************************
 * histcross v2.0
 * File: add.php
 * Created: 12.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="inferences form">
<?php echo $form->create('Inference');?>
	<fieldset>
 		<legend><?php __('Add Inference');?></legend>
	<?php
		echo '<label>'.__('Inference Type', true).'</label>';
		echo $form->error('inference_type_id', __('Please select one inference type', true));
		echo '<div class="inferencetypes">'.$form->radio('inference_type_id', $inferenceTypes, array('legend' => false, 'separator' => '</div><div class="inferencetypes">')).'</div><div style="clear: left;"></div>';
		__('a: ');
		echo $form->select('p1_id', $relationTypes);
		echo $form->error('p1_id');
		echo $form->input('p1_dir_from', array('label' => __('Take second parameter of a (switch direction of arrow)', true)));
		__('b: ');
		echo $form->select('p2_id', $relationTypes);
		echo $form->error('p3_id');
		echo $form->input('p2_dir_from', array('label' => __('Take second parameter of b (switch direction of arrow)', true)));
		__('c: ');
		echo $form->select('p3_id', $relationTypes);
		echo $form->error('p3_id');
		echo $form->input('p3_dir_from', array('label' => __('Take second parameter of c (switch direction of arrow)', true)));
	?>
	</fieldset>
<?php echo $form->end(__('Add!', true));?>
</div>
<? if ($linkid != null) : ?>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Back to the Relation Type', true), '/relation_types/view/'.$linkid);?></li>
	</ul>
</div>
<? endif; ?>
