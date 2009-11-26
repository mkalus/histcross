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
	'Pictograms', //Title
	'Pictograms', //Controller
	$pictograms, //Data
	array( //Columns for header
		'0' => 'Pictogram',
		'title' => 'Title'),
	array(
		array(
			'model' => 'Pictogram', //Model to take data from
			'field' => 'id', //Field name
			'class' => 'nobreak', //class of td
			'format' => 'iconandedit', //special format
			'refmodel' => 'Pictogram', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'Pictogram', //Model to take data from
			'field' => 'id', //Field name
			'class' => '', //class of td
			'format' => 'iconbig', //special format
			'refmodel' => '', //for format-Method: Reference Model
			'reffield' => '', //for format-Method: Reference Field
		),
		array(
			'model' => 'Pictogram', //Model to take data from
			'field' => 'title', //Field name
			'class' => '', //class of td
			'format' => '', //special format
			'refmodel' => '', //for format-Method: Reference Model
			'reffield' => '', //for format-Method: Reference Field
		),
	),
	'icon_pictogram.png'
);
?>