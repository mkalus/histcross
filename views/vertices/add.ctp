<?php
/*********************************************************
 * histcross v2.0
 * File: add.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="vertices form">
<?php echo $form->create('Vertex');?>
	<fieldset>
 		<legend><?php __('Add Vertex');?></legend>
	<?php
		echo $form->input('vertex_type_id');
		echo $this->element('form_pictogram');
		echo $form->input('title');
		echo $this->element('form_dates');
		echo $this->element('form_comment');
		echo $this->element('form_geo');
	?>
	</fieldset>
<?php echo $form->end(__('Add!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Vertices', true), array('action'=>'index'));?></li>
	</ul>
</div>
