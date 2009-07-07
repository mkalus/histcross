<?
/*********************************************************
 * histcross v2.0
 * File: login.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//Add md5-library
$javascript->link('sha1', false);

echo $form->create('User', array('action' => 'user_login', 'onSubmit' => 'return doChallengeResponse();'));
echo $form->input('username');
echo $form->input('password', array('value' => ''));
echo $form->input('challenge', array('type' => 'hidden', 'value' => $session->read('challenge')));
echo $form->input('user_ident', array('type' => 'hidden', 'value' => ''));
echo $form->input('referer', array('type' => 'hidden', 'value' => $referer));
echo $form->end('Login');
?>