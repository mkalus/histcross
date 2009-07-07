<?
/*********************************************************
 * histcross v2.0
 * File: edit.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="bibliographies form">
<?php echo $form->create('Bibliography');?>
	<fieldset>
 		<legend><?php __('Edit Bibliography');?></legend>
	<?php
		echo $form->input('id');
		echo $this->element('form_undelete');
		echo $form->input('shorttitle', array('after' => __('Short bibliographic entry used in lists', true)));
		echo $form->input('longtitle', array('after' => __('Full bibliographic entry', true)));
		echo $form->input('shortref', array('after' => __('Reference entry for texts', true)));
		echo $this->element('form_comment');
	?>
	</fieldset>
<?php echo $form->end(__('Change!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Bibliography.id')), null, sprintf(__('Are you sure you want to delete %s?', true), $form->value('Bibliography.shorttitle'))); ?></li>
		<li><?php echo $html->link(__('List Bibliographies', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('View', true), array('action'=>'view', $form->value('Bibliography.id'))); ?></li>
	</ul>
</div>
