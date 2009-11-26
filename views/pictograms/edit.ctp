<?php
/*********************************************************
 * histcross v2.0
 * File: edit.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="pictograms form">
<?php echo $form->create('Pictogram', array('enctype' => 'multipart/form-data'));?>
	<fieldset>
 		<legend><?php __('Edit Pictogram');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('picture', array('between'=>'<br />','type'=>'file'));
		//echo $form->input('Pictogram.picture.remove', array('type' => 'checkbox'));  
	?>
	<div class="input pictures"><label><?php __('Current Pictures'); ?></label>
	<?php __('Big: '); echo $hcSupport->getIconHTML($form->value('Pictogram.id'), true); ?>
	<?php __('Small: '); echo $hcSupport->getIconHTML($form->value('Pictogram.id'), false); ?></div>
	</fieldset>
<?php echo $form->end(__('Change!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Pictogram.id')), null, sprintf(__('Are you sure you want to delete %s? This cannot be reversed!', true), $form->value('Pictogram.title'))); ?></li>
		<li><?php echo $html->link(__('List Pictograms', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('View', true), array('action'=>'view', $form->value('Pictogram.id'))); ?></li>
	</ul>
</div>
