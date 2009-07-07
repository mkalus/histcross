<?php
/*********************************************************
 * histcross v2.0
 * File: possible_inferences.ctp
 * Created: 16.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//define links and icons
$from_object_link = $html->link(
	$relation['VertexFrom']['title'],
	array(
		'controller'=>'vertices',
		'action'=>'view',
		$relation['VertexFrom']['id']
	)
);

$from_object_icon = $hcSupport->getIconHTML($relation['VertexFrom']['pictogram_id'], true);

$to_object_link = $html->link(
	$relation['VertexTo']['title'],
	array(
		'controller'=>'vertices',
		'action'=>'view',
		$relation['VertexTo']['id']
	)
);

$to_object_icon = $hcSupport->getIconHTML($relation['VertexTo']['pictogram_id'], true);

$type_link = $html->link(
	$relation['RelationType']['title_from'],
	array(
		'controller'=>'relation_types',
		'action'=>'view',
		$relation['RelationType']['id']
	)
);

$type_icon = $hcSupport->getIconHTML($relation['RelationType']['pictogram_id'], true);

$classlink = $html->link(
	$relation['RelationType']['RelationClass']['title'],
	array(
		'controller'=>'relation_classes',
		'action'=>'view',
		$relation['RelationType']['RelationClass']['id']
	)
);
?>

<div class="viewentry">
	<div class="relations view">
		<h2><?php __('Inferences for:'); ?></h2>
		<h2><?php
			echo $hcSupport->createIconandEditLink($relation['Relation']['id'],
				'icon_relation.gif',
				 __('Relation', true)).
				 $from_object_icon.' '.$from_object_link.' &rArr; '.
				 $type_icon.' '.$type_link.' &rArr; '.
				 $to_object_icon.' '.$to_object_link.' '; ?><br />
			<span style="font-size:smaller;"><?php  __('Relation'); printf(__(' of the Type %s and the Class %s', true), $type_link, $classlink); ?></span>
		</h2>
	</div>
&nbsp;
<?
//Show possible inferences
echo $this->element('view_possible_inferences', array('relation' => $relation, 'inferences' => $inferences));
?>
</div>
&nbsp;
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('View', true), array('action'=>'view', $relation['Relation']['id'])); ?></li>
		<li><?php echo $html->link(__('List Relations', true), array('action'=>'index'));?></li>
	</ul>
</div>
