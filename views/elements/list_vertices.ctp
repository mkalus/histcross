<?php
/*********************************************************
 * histcross v2.0
 * File: list_vertices.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

if (!isset($elementtitle)) $elementtitle = 'Vertices';
if (!isset($useajax)) $useajax = false;

$paginatedTable->createTable(
	$elementtitle, //Title
	'Vertices', //Controller
	$vertices, //Data
	array( //Columns for header
		'title' => 'Title',
		'VertexType.title' => 'Type',
		'start_time' => 'From',
		'stop_time' => 'To',),
	array(
		array(
			'model' => 'Vertex', //Model to take data from
			'field' => 'id', //Field name
			'class' => 'nobreak', //class of td
			'format' => 'iconandedit', //special format
			'refmodel' => 'Vertex', //for format-Method: Reference Model
			'reffield' => 'id', //for format-Method: Reference Field
		),
		array(
			'model' => 'Vertex', //Model to take data from
			'field' => 'title', //Field name
			'class' => '', //class of td
			'format' => 'iconandlink', //special format
			'refmodel' => 'Vertex', //for format-Method: Reference Model
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
			'model' => 'Vertex', //Model to take data from
			'field' => 'start_time', //Field name
			'class' => 'number', //class of td
			'format' => 'timeentry', //special format
			'refmodel' => 'Vertex', //for format-Method: Reference Model
			'reffield' => 'start_time', //for format-Method: Reference Field
		),
		array(
			'model' => 'Vertex', //Model to take data from
			'field' => 'stop_time', //Field name
			'class' => 'number', //class of td
			'format' => 'timeentry', //special format
			'refmodel' => 'Vertex', //for format-Method: Reference Model
			'reffield' => 'stop_time', //for format-Method: Reference Field
		),
	),
	'icon_vertex.gif',
	$useajax
);
?>