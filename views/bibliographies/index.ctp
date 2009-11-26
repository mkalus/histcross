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
	'Bibliographies', //Title
	'bibliographies', //Controller
	$bibliographies, //Data
	array( //Columns for header
		'shortref' => 'Short Reference',
		'longtitle' => 'Long Title'),
	array(
		array(
			'model' => 'Bibliography', //Model to take data from
			'field' => 'id', //Field name
			'class' => 'nobreak', //class of td
			'format' => 'iconandedit', //special format
			'refmodel' => 'Bibliography', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'Bibliography', //Model to take data from
			'field' => 'shortref', //Field name
			'class' => '', //class of td
			'format' => 'link', //special format
			'refmodel' => 'Bibliography', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'Bibliography', //Model to take data from
			'field' => 'longtitle', //Field name
			'class' => '', //class of td
			'format' => 'link', //special format
			'refmodel' => 'Bibliography', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
	),
	'icon_book.gif'
);
?>