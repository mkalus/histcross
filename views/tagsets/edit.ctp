<?php
/*********************************************************
 * histcross v2.0
 * File: edit.ctp
 * Created: 15.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
?>
<div class="tagsets form">
<?php echo $form->create('Tagset');?>
	<fieldset>
 		<legend><?php __('Edit Tag Set');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('group');
	?>
	</fieldset>
<?php echo $form->end(__('Change!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Tagset.id')), null, sprintf(__('Are you sure you want to delete %s?', true), $form->value('Tagset.group').':'.$form->value('Tagset.title'))); ?></li>
		<li><?php echo $html->link(__('List Tag Sets', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('View', true), array('action'=>'view', $form->value('Tagset.id'))); ?></li>
	</ul>
</div>
