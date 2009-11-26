<?php
/*********************************************************
 * histcross v2.0
 * File: add.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="relationTypes form">
<?php echo $form->create('RelationType');?>
	<fieldset>
 		<legend><?php __('Add RelationType');?></legend>
	<?php
		echo $form->input('relation_class_id');
		echo $this->element('form_pictogram');
		echo $form->input('title_from');
		echo $form->input('title_to');
		echo $this->element('form_dategeo');
		echo $this->element('form_comment');
		echo $form->input('vertex_types_from');
		echo $multiCheckbox->multiCheckBox($vertexTypes, 'RelationType', 'vertex_types_from', $form->value('RelationType.vertex_types_from'), __('Allowed Vertex from (empty to allow all)', true));
		echo $multiCheckbox->multiCheckBox($vertexTypes, 'RelationType', 'vertex_types_to', $form->value('RelationType.vertex_types_to'), __('Allowed Vertex to (empty to allow all)', true));
	?>
	</fieldset>
<?php echo $form->end(__('Add!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List RelationTypes', true), array('action'=>'index'));?></li>
	</ul>
</div>
