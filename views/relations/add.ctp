<?
/*********************************************************
 * histcross v2.0
 * File: add.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="relations form">
<?php echo $form->create('Relation');?>
	<fieldset>
 		<legend><?php __('Add Relation');?></legend>
	<?php
		echo $form->input('from_vertex_id', array('readonly' => 'readonly', 'div' => 'rightblock', 'label' => 'Id'));
		echo $strictAutocomplete->autoComplete('relation_from_vertex', '/vertices/ajax_autocomplete', array('label'=>'From Vertex', 'strict'=>true, 'callback' => 'function(element, entry) { return entry + "&direction=from&relationType=" + $("RelationRelationTypeId").value; }'));
		echo $form->input('relation_type_id');
		echo $form->input('to_vertex_id', array('readonly' => 'readonly', 'div' => 'rightblock', 'label' => 'Id'));
		echo $strictAutocomplete->autoComplete('relation_to_vertex', '/vertices/ajax_autocomplete', array('label'=>'To Vertex', 'strict'=>true, 'callback' => 'function(element, entry) { return entry + "&direction=to&relationType=" + $("RelationRelationTypeId").value; }'));
		echo $this->element('form_dates');
		echo $this->element('form_comment');
		echo $this->element('form_geo');
	?>
	</fieldset>
<?php echo $form->end(__('Add!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Relations', true), array('action'=>'index'));?></li>
	</ul>
</div>
