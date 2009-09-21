<?
/*********************************************************
 * histcross v2.0
 * File: view.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
?>
<div class="viewentry">
	<div class="users view">
		<h2><?php
			echo $hcSupport->createIconandEditLink($user['User']['id'],
				'user.png',
				 __('User', true)).
				 Sanitize::html($user['User']['name']);?><br />
			<span style="font-size:smaller;"><?php  __('User');?></span>
		</h2>
		
		<dl class="dataentry">
			<dt><?php  __('Username');?></dt>
			<dd><?php echo Sanitize::html($user['User']['username']); ?></dd>
			<dt><?php  __('Group');?></dt>
			<dd><?php echo Sanitize::html($user['User']['group']); ?></dd>
			<dt><?php  __('Always show network');?></dt>
			<dd><?php $user['User']['always_show_network']?__('yes'):__('no'); ?></dd>
			<dt><?php  __('Created');?></dt>
			<dd><?php echo $user['User']['created']; ?></dd>
			<dt><?php  __('Modified');?></dt>
			<dd><?php echo $user['User']['modified']; ?></dd>
			<dt><?php  __('Last Login');?></dt>
			<dd><?php echo $user['User']['lastlogin']; ?></dd>
		</dl>
	</div>
</div>
<div class="actions">
	<ul>
<? if ($auth->user('group') == 'admin' || $auth->user('id') == $user['User']['id']) : ?>
		<li><?php echo $html->link(__('Change Password', true), array('action'=>'changepassword', $user['User']['id']), null, null); ?></li>
<? endif;
	if ($auth->user('group') == 'admin') : ?>
		<li><?php echo $html->link(__('List Users', true), array('action'=>'index'));?></li>
<? endif; ?>
	</ul>
</div>
