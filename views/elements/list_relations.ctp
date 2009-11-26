<?php
/*********************************************************
 * histcross v2.0
 * File: list_relations.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

if (!isset($elementtitle)) $elementtitle = 'Relations';
if (!isset($useajax)) $useajax = false;
if (!isset($uniqhandle)) $uniqhandle = '';

$paginatedTable->createTable(
	$elementtitle, //Title
	'Relations', //Controller
	$relations, //Data
	array( //Columns for header
		'VertexFrom.title' => 'From Vertex',
		'RelationType.title_from' => 'Type',
		'VertexTo.title' => 'To Vertex',
		'start_time' => 'From',
		'stop_time' => 'To',),
	array(
		array(
			'model' => 'Relation', //Model to take data from
			'field' => 'id', //Field name
			'class' => 'nobreak', //class of td
			'format' => 'iconandedit', //special format
			'refmodel' => 'Relation', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'VertexFrom', //Model to take data from
			'field' => 'title', //Field name
			'class' => '', //class of td
			'format' => 'iconandlink', //special format
			'refmodel' => 'VertexFrom', //for format-Method: Reference Model
			'refmodelname' => 'Vertex', //Reference Model Actual Name
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
			'model' => 'VertexTo', //Model to take data from
			'field' => 'title', //Field name
			'class' => '', //class of td
			'format' => 'iconandlink', //special format
			'refmodel' => 'VertexTo', //for format-Method: Reference Model
			'refmodelname' => 'Vertex', //Reference Model Actual Name
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'Relation', //Model to take data from
			'field' => 'start_time', //Field name
			'class' => '', //class of td
			'format' => 'timeentry', //special format
			'refmodel' => 'Relation', //for format-Method: Reference Model
			'reffield' => 'start_time', //for format-Method: Reference Field
		),
		array(
			'model' => 'Relation', //Model to take data from
			'field' => 'stop_time', //Field name
			'class' => '', //class of td
			'format' => 'timeentry', //special format
			'refmodel' => 'Relation', //for format-Method: Reference Model
			'reffield' => 'stop_time', //for format-Method: Reference Field
		),
	),
	'icon_relation.gif',
	$useajax,
	$uniqhandle
);
?>