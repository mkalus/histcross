<?php
/*********************************************************
 * histcross v2.0
 * File: edit.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="relationClasses form">
<?php echo $form->create('RelationClass');?>
	<fieldset>
 		<legend><?php __('Edit RelationClass');?></legend>
	<?php
		echo $form->input('id');
		echo $this->element('form_undelete');
		echo $form->input('title');
		echo $this->element('form_comment');
	?>
	</fieldset>
<?php echo $form->end(__('Change!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('RelationClass.id')), null, sprintf(__('Are you sure you want to delete %s?', true), $form->value('RelationClass.title'))); ?></li>
		<li><?php echo $html->link(__('List RelationClasses', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('View', true), array('action'=>'view', $form->value('RelationClass.id'))); ?></li>
	</ul>
</div>
