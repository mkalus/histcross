<?php
/*********************************************************
 * histcross v2.0
 * File: user.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class User extends AppModel {
	var $actsAs = array('Containable');

	var $name = 'User';
	var $validate = array(
		'username' => array(
			'minLength' => array('rule' => array('minLength', 4), 'message' => 'Minimum length is 4 letters', 'last' => true),
			'isUnique' => array('rule' => 'isUnique', 'message' => 'Username must be unique'),
		),
		'password' => array('rule' => array('CheckPassword'), 'message' => 'Password must have at least 6 characters'),
		'password2' => array('rule' => array('CheckPasswordMatch'), 'message' => 'Passwords did not match'),
		'name' => array('notempty'),
		'deleted' => array('numeric'),
		'group' => array(
			'rule' => array('checkGroup', 'group'),
			'message' => 'The only groups allowed are admin, poweruser, and user.'
		)
	);
	
	/**
	 * Checks for correct group names
	 */
	function checkGroup($data, $field) {
		$validGroups = array('admin', 'poweruser', 'user');
		if ($this->hasField($field) && in_array($data[$field], $validGroups)) {
			return true;
		}
		return false;
	}

	function CheckPassword($data) {
		if(!isset($this->data['User']['password2']))
			return true; //Only confirm password strength if we're collecting a new password (i.e. password2 is set).
		
		return strlen($this->data['User']['password2']) >= 6;
	}
	
	function CheckPasswordMatch($data) {
		return $this->data['User']['password'] == $this->data['User']['password2'];
	}
}
?>