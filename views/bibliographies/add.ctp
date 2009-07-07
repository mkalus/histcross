<?
/*********************************************************
 * histcross v2.0
 * File: add.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="bibliographies form">
<?php echo $form->create('Bibliography');?>
	<fieldset>
 		<legend><?php __('Add Bibliography');?></legend>
	<?php
		echo $form->input('shorttitle', array('after' => __('Short bibliographic entry used in lists', true)));
		echo $form->input('longtitle', array('after' => __('Full bibliographic entry', true)));
		echo $form->input('shortref', array('after' => __('Reference entry for texts', true)));
		echo $this->element('form_comment');
	?>
	</fieldset>
<?php echo $form->end(__('Add!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Bibliographies', true), array('action'=>'index'));?></li>
	</ul>
</div>
