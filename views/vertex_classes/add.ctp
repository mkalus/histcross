<?php
/*********************************************************
 * histcross v2.0
 * File: add.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="vertexClasses form">
<?php echo $form->create('VertexClass');?>
	<fieldset>
 		<legend><?php __('Add VertexClass');?></legend>
	<?php
		echo $form->input('title');
		echo $this->element('form_comment');
		echo $form->input('sortkey', array('after' => __('Numeric value, order is ascending (1 = high, 255 = low)', true)));
	?>
	</fieldset>
<?php echo $form->end(__('Add!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List VertexClasses', true), array('action'=>'index'));?></li>
	</ul>
</div>
