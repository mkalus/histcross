<?php
/*********************************************************
 * histcross v2.0
 * File: add.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="pictograms form">
<?php echo $form->create('Pictogram', array('enctype' => 'multipart/form-data'));?>
	<fieldset>
 		<legend><?php __('Add Pictogram');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('picture', array('between'=>'<br />','type'=>'file'));
		//echo $form->input('Pictogram.picture.remove', array('type' => 'checkbox'));  
	?>
	</fieldset>
<?php echo $form->end(__('Add!', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Pictograms', true), array('action'=>'index'));?></li>
	</ul>
</div>
