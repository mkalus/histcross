<?php
/*********************************************************
 * histcross v2.0
 * File: viewnetwork.ctp
 * Created: 16.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//prepare data to be worked upon
$network->prepareData($model, $id, $vertices, $edges);
//create file
$filename = $network->buildFile();
//create better graph file
$dotfile = $network->createVisualFile('dot');
//create image
$img = $network->createNetwork();

echo $html->link($html->image($img['small']),
	'/img/'.$img['big'], array('target' => '_blank'), false, false); ?>
<br />
<? echo $html->link(__('Graphviz Data File', true), '/'.$filename, array('target' => '_blank')); ?>
<br />
<? echo $html->link(__('Coordinated DOT-File', true), '/'.$dotfile, array('target' => '_blank')); ?>