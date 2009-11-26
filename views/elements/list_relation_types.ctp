<?php
/*********************************************************
 * histcross v2.0
 * File: list_relation_types.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

if (!isset($elementtitle)) $elementtitle = 'Relation Types';
if (!isset($useajax)) $useajax = false;

$paginatedTable->createTable(
	$elementtitle, //Title
	'RelationTypes', //Controller
	$relationTypes, //Data
	array( //Columns for header
		'title_from' => 'Title From',
		'title_to' => 'Title To',
		'RelationClass.title' => 'Class'),
	array(
		array(
			'model' => 'RelationType', //Model to take data from
			'field' => 'id', //Field name
			'class' => 'nobreak', //class of td
			'format' => 'iconandedit', //special format
			'refmodel' => 'RelationType', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'RelationType', //Model to take data from
			'field' => 'title_from', //Field name
			'class' => '', //class of td
			'format' => 'iconandlink', //special format
			'refmodel' => 'RelationType', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'RelationType', //Model to take data from
			'field' => 'title_to', //Field name
			'class' => '', //class of td
			'format' => 'iconandlink', //special format
			'refmodel' => 'RelationType', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'RelationClass', //Model to take data from
			'field' => 'title', //Field name
			'class' => '', //class of td
			'format' => 'link', //special format
			'refmodel' => 'RelationClass', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
	),
	'icon_relationtype.gif',
	$useajax
);
?>