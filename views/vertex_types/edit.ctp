<?php
/*********************************************************
 * histcross v2.0
 * File: edit.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="vertexTypes form">
<?php echo $form->create('VertexType');?>
	<fieldset>
 		<legend><?php __('Edit VertexType');?></legend>
	<?php
		echo $form->input('id');
		echo $this->element('form_undelete');
		echo $form->input('vertex_classes_id');
		echo $form->input('title');
		echo $this->element('form_pictogram');
		echo $this->element('form_dategeo');
		echo $this->element('form_comment');
	?>
	</fieldset>
<?php echo $form->end(__('Change!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('VertexType.id')), null, sprintf(__('Are you sure you want to delete %s?', true), $form->value('VertexType.title'))); ?></li>
		<li><?php echo $html->link(__('List VertexTypes', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('View', true), array('action'=>'view', $form->value('VertexType.id'))); ?></li>
	</ul>
</div>
