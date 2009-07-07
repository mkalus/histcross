<?
/*********************************************************
 * histcross v2.0
 * File: edit.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="vertices form">
<?php echo $form->create('Vertex');?>
	<fieldset>
 		<legend><?php __('Edit Vertex');?></legend>
	<?php
		echo $form->input('id');
		echo $this->element('form_undelete');
		echo $form->input('vertex_type_id');
		echo $this->element('form_pictogram');
		echo $form->input('title');
		echo $this->element('form_dates');
		echo $this->element('form_comment');
		echo $this->element('form_geo');
	?>
	</fieldset>
<?php echo $form->end(__('Change!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Vertex.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Vertex.id'))); ?></li>
		<li><?php echo $html->link(__('List Vertices', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('View', true), array('action'=>'view', $form->value('Vertex.id'))); ?></li>
	</ul>
</div>
