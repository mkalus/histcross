<?
/*********************************************************
 * histcross v2.0
 * File: add.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="relationClasses form">
<?php echo $form->create('RelationClass');?>
	<fieldset>
 		<legend><?php __('Add RelationClass');?></legend>
	<?php
		echo $form->input('title');
		echo $this->element('form_comment');
	?>
	</fieldset>
<?php echo $form->end(__('Add!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List RelationClasses', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
	</ul>
</div>
