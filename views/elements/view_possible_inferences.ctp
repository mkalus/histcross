<?php
/*********************************************************
 * histcross v2.0
 * File: view_possible_inferences.ctp
 * Created: 16.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//message or warning?
if (isset($warning) && $warning != null) : ?>
<div class="message"><?=$warning?></div>
<? endif; ?>

<? if (count($inferences) > 0) : ?>
<div class="possible_inferences">
<h3><? __('Possible Derived Relations'); ?></h3>
<table class="listtable">
	<tr>
		<th><? __('From Vertex'); ?></th>
		<th><? __('Type'); ?></th>
		<th><? __('To Vertex'); ?></th>
<? if ($auth->sessionValid()) : ?>
		<th><? __('Add'); ?></th>
<? endif; ?>
	</tr>
<?		$counter = 0;
		foreach($inferences as $inference) : ?>
	<tr<? if($counter++%2==0) echo ' class="altrow"';?>>
<?
			if ($inference['exists']) $class = 'grey'; else $class = null;
?>
		<td><?=$html->link($inference['from_title'], '/vertices/view/'.$inference['from_id'], array('class' => $class))?></td>
		<td><?=$html->link($inference['relation_title'], '/relation_types/view/'.$inference['relation_type_id'], array('class' => $class))?></td>
		<td><?=$html->link($inference['to_title'], '/vertices/view/'.$inference['to_id'], array('class' => $class))?></td>
<? 			if ($auth->sessionValid()) : ?>
<?
				//prepare some data
				$htmlid = 'possible_inference_'.$inference['from_id'].'_'.$inference['relation_type_id'].'_'.$inference['to_id'];
?>
		<td class="center" id="<? echo $htmlid; ?>"><?
				if ($inference['exists']) echo $html->image('icons/icon_ok.png', array('width' => 16, 'height' => 16, 'alt' => __('Inference exists', true), 'title' => __('Inference exists', true)));
				else {
					$options = array('controller' => 'relations',
						'action' => 'add_inference',
						$relation['Relation']['id'],
						'from_id' => $inference['from_id'],
						'relation_type_id' => $inference['relation_type_id'],
						'to_id' => $inference['to_id']);
					echo $ajax->link($html->image('icons/icon_addxsmall.png', array('width' => 16, 'height' => 16, 'alt' => __('Add', true), 'title' => __('Add', true), 'id' => $htmlid.'img')),
						$options,
						array('update' => $htmlid, 'url' => $options, 'before' => '$('."'".$htmlid."'".').innerHTML = '."'<img src=\"/img/ajax-loader.gif\">';"),
						null, false);
				} 
				//;
		?></td>
<? 			endif; ?>
	</tr>
<?		endforeach; ?>
</table>
</div>
<? endif; ?>