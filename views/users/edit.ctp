<?php
/*********************************************************
 * histcross v2.0
 * File: edit.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Edit User');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('username', array('after' => __('Username, alphanumeric', true)));
		echo $form->input('name', array('after' => __('Real name of user', true)));
		echo $form->input('always_show_network', array('label' => __('Always show network', true), 'after' => __('Set to always load network applet automatically', true)));
		echo $this->element('form_undelete');
		if ($auth->user('group') == 'admin') {
			echo $form->input('group', array(
				'type' => 'select',
				'options' => array(
					'user' => 'User',
					'superuser' => 'Super-User',
					'admin' => 'Administrator',
				),
				'after' => __('Set the privileges of users', true)
			));
		}
	?>
	</fieldset>
<?php echo $form->end(__('Change!', true));?>
</div>
<div class="actions">
	<ul>
<?php if (AccessKeeper::checkAccess('Users', 'delete', $auth->user('group'))) : ?>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('User.id')), null, sprintf(__('Are you sure you want to delete %s?', true), $form->value('User.name'))); ?></li>
<?php endif;
	if ($auth->user('group') == 'admin') : ?>
		<li><?php echo $html->link(__('List Users', true), array('action'=>'index'));?></li>
<?php endif; ?>
	</ul>
</div>
