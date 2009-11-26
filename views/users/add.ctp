<?php
/*********************************************************
 * histcross v2.0
 * File: add.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Add User');?></legend>
	<?php
		echo $form->input('username', array('after' => __('Username, alphanumeric', true)));
		echo $form->input('password', array('value'=>'', 'after' => __('Password with a minimum length of 6 letters', true)));
		echo $form->input('password2', array('label'=> __('Repeat Password', true),
			'type'=>'password', 'value'=>'')); 
		echo $form->input('name', array('after' => __('Real name of user', true)));
		echo $form->input('group', array(
			'type' => 'select',
			'options' => array(
				'user' => 'User',
				'superuser' => 'Super-User',
				'admin' => 'Administrator',
			),
			'after' => __('Set the privileges of users', true)
		));
	?>
	</fieldset>
<?php echo $form->end(__('Add!', true));?>
</div>

<?php	if ($auth->user('group') == 'admin') : ?>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Users', true), array('action'=>'index'));?></li>
	</ul>
</div>
<?php endif; ?>
