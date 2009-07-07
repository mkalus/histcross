<?php
/*********************************************************
 * histcross v2.0
 * File: add_set.ctp
 * Created: 15.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
?>
<div class="tagsets form">
<?php echo $form->create('Tagset', array('action' => 'add_set'));?>
	<fieldset>
 		<legend><?php __('Add Tag Set');?></legend>
<p><?php __('Add new tag set name below. Classification of sets can be achieved by using the schema &quot;class:set name&quot;.'); ?></p>
	<?php
		echo $form->input('title');
		echo $form->input('vertex_id', array('type' => 'hidden', 'value' => $id));
	?>
	</fieldset>
<?php echo $form->end(__('Add!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Tagsets', true), array('action'=>'index'));?></li>
	</ul>
</div>