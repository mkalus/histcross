<?
/*********************************************************
 * histcross v2.0
 * File: edit.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="vertexClasses form">
<?php echo $form->create('VertexClass');?>
	<fieldset>
 		<legend><?php __('Edit VertexClass');?></legend>
	<?php
		echo $form->input('id');
		echo $this->element('form_undelete');
		echo $form->input('title');
		echo $this->element('form_comment');
		echo $form->input('sortkey', array('after' => __('Numeric value, order is ascending (1 = high, 255 = low)', true)));
	?>
	</fieldset>
<?php echo $form->end(__('Change!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('VertexClass.id')), null, sprintf(__('Are you sure you want to delete %s?', true), $form->value('VertexClass.title'))); ?></li>
		<li><?php echo $html->link(__('List VertexClasses', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('View', true), array('action'=>'view', $form->value('VertexClass.id'))); ?></li>
	</ul>
</div>
