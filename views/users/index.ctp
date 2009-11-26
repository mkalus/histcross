<?php
/*********************************************************
 * histcross v2.0
 * File: index.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

$paginatedTable->createTable(
	'Users', //Title
	'Users', //Controller
	$users, //Data
	array( //Columns for header
		'name' => 'Name',
		'group' => 'Group',
		'0' => 'Last Login',
		'1' => ''),
	array(
		array(
			'model' => 'User', //Model to take data from
			'field' => 'id', //Field name
			'class' => 'nobreak', //class of td
			'format' => 'iconandedit', //special format
			'refmodel' => 'User', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'User', //Model to take data from
			'field' => 'name', //Field name
			'class' => '', //class of td
			'format' => 'link', //special format
			'refmodel' => 'User', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'User', //Model to take data from
			'field' => 'group', //Field name
			'class' => '', //class of td
			'format' => '', //special format
			'refmodel' => '', //for format-Method: Reference Model
			'reffield' => '', //for format-Method: Reference Field
		),
		array(
			'model' => 'User', //Model to take data from
			'field' => 'lastlogin', //Field name
			'class' => '', //class of td
			'format' => '', //special format
			'refmodel' => '', //for format-Method: Reference Model
			'reffield' => '', //for format-Method: Reference Field
		),
		array(
			'model' => 'User', //Model to take data from
			'field' => 'id', //Field name
			'class' => '', //class of td
			'format' => 'changepassword', //special format
			'refmodel' => 'User', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
	),
	'user.png'
);
?>