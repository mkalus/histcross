<?
/*********************************************************
 * histcross v2.0
 * File: list_vertex_classes.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

if (!isset($elementtitle)) $elementtitle = 'Vertex Classes';
if (!isset($useajax)) $useajax = false;

$paginatedTable->createTable(
	$elementtitle, //Title
	'VertexClasses', //Controller
	$vertexClasses, //Data
	array( //Columns for header
		'title' => 'Title',
		'sortkey' => 'Sortkey'),
	array(
		array(
			'model' => 'VertexClass', //Model to take data from
			'field' => 'id', //Field name
			'class' => 'nobreak', //class of td
			'format' => 'iconandedit', //special format
			'refmodel' => 'VertexClass', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'VertexClass', //Model to take data from
			'field' => 'title', //Field name
			'class' => '', //class of td
			'format' => 'link', //special format
			'refmodel' => 'VertexClass', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'VertexClass', //Model to take data from
			'field' => 'sortkey', //Field name
			'class' => 'number', //class of td
			'format' => '', //special format
			'refmodel' => '', //for format-Method: Reference Model
			'reffield' => '', //for format-Method: Reference Field
		),
	),
	'icon_vertexclass.gif',
	$useajax
);
?>