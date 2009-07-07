<?
/*********************************************************
 * histcross v2.0
 * File: add.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="vertexTypes form">
<?php echo $form->create('VertexType');?>
	<fieldset>
 		<legend><?php __('Add VertexType');?></legend>
	<?php
		echo $form->input('vertex_classes_id');
		echo $form->input('title');
		echo $this->element('form_pictogram');
		echo $this->element('form_dategeo');
		echo $this->element('form_comment');
	?>
	</fieldset>
<?php echo $form->end(__('Add!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List VertexTypes', true), array('action'=>'index'));?></li>
	</ul>
</div>
