<?
/*********************************************************
 * histcross v2.0
 * File: list_relations_classes.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

if (!isset($elementtitle)) $elementtitle = 'Relation Classes';
if (!isset($useajax)) $useajax = false;

$paginatedTable->createTable(
	$elementtitle, //Title
	'RelationClasses', //Controller
	$relationClasses, //Data
	array( //Columns for header
		'title' => 'Title'),
	array(
		array(
			'model' => 'RelationClass', //Model to take data from
			'field' => 'id', //Field name
			'class' => 'nobreak', //class of td
			'format' => 'iconandedit', //special format
			'refmodel' => 'RelationClass', //for format-Method: Reference Model
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
	'icon_relationclass.gif',
	$useajax
);
?>