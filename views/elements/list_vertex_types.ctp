<?
/*********************************************************
 * histcross v2.0
 * File: list_vertex_types.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

if (!isset($elementtitle)) $elementtitle = 'Vertex Types';
if (!isset($useajax)) $useajax = false;

$paginatedTable->createTable(
	$elementtitle, //Title
	'VertexTypes', //Controller
	$vertexTypes, //Data
	array( //Columns for header
		'title' => 'Title',
		'VertexClass.title' => 'Class'),
	array(
		array(
			'model' => 'VertexType', //Model to take data from
			'field' => 'id', //Field name
			'class' => 'nobreak', //class of td
			'format' => 'iconandedit', //special format
			'refmodel' => 'VertexType', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'VertexType', //Model to take data from
			'field' => 'title', //Field name
			'class' => '', //class of td
			'format' => 'iconandlink', //special format
			'refmodel' => 'VertexType', //for format-Method: Reference Model
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
	),
	'icon_vertextype.gif',
	$useajax
);
?>