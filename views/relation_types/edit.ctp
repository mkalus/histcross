<?php
/*********************************************************
 * histcross v2.0
 * File: edit.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="relationTypes form">
<?php echo $form->create('RelationType');?>
	<fieldset>
 		<legend><?php __('Edit RelationType');?></legend>
	<?php
		echo $form->input('id');
		echo $this->element('form_undelete');
		echo $form->input('relation_class_id');
		echo $this->element('form_pictogram');
		echo $form->input('title_from');
		echo $form->input('title_to');
		echo $this->element('form_dategeo');
		echo $this->element('form_comment');
		echo $multiCheckbox->multiCheckBox($vertexTypes, 'RelationType', 'vertex_types_from', $form->value('RelationType.vertex_types_from'), __('Allowed Vertex from (empty to allow all)', true));
		echo $multiCheckbox->multiCheckBox($vertexTypes, 'RelationType', 'vertex_types_to', $form->value('RelationType.vertex_types_to'), __('Allowed Vertex to (empty to allow all)', true));
	?>
	</fieldset>
<?php echo $form->end(__('Change!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('RelationType.id')), null, sprintf(__('Are you sure you want to delete %s?', true), $form->value('RelationType.title_from'))); ?></li>
		<li><?php echo $html->link(__('List RelationTypes', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('View', true), array('action'=>'view', $form->value('RelationType.id'))); ?></li>
	</ul>
</div>
