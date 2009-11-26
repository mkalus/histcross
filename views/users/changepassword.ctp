<?php
/*********************************************************
 * histcross v2.0
 * File: changepassword.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="users form">
<?php echo $form->create('User', array('action' => 'changepassword'));?>
	<fieldset>
 		<legend><?php __('Change Password');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('password', array('value'=>'', 'after' => __('Password with a minimum length of 6 letters', true)));
		echo $form->input('password2', array('label'=>'Repeat Password',
			'type'=>'password', 'value'=>'')); 
	?>
	</fieldset>
<?php echo $form->end(__('Change!', true));?>
</div>

<?php	if ($auth->user('group') == 'admin') : ?>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Users', true), array('action'=>'index'));?></li>
	</ul>
</div>
<?php endif; ?>
