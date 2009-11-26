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
<div class="message"><?php echo($warning); ?></div>
<?php endif; ?>

<?php if (count($inferences) > 0) : ?>
<div class="possible_inferences">
<h3><?php __('Possible Derived Relations'); ?></h3>
<table class="listtable">
	<tr>
		<th><?php __('From Vertex'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('To Vertex'); ?></th>
<?php if ($auth->sessionValid()) : ?>
		<th><?php __('Add'); ?></th>
<?php endif; ?>
	</tr>
<?php		$counter = 0;
		foreach($inferences as $inference) : ?>
	<tr<?php if($counter++%2==0) echo ' class="altrow"';?>>
<?php
			if ($inference['exists']) $class = 'grey'; else $class = null;
?>
		<td><?php echo($html->link($inference['from_title'], '/vertices/view/'.$inference['from_id'], array('class' => $class))); ?></td>
		<td><?php echo($html->link($inference['relation_title'], '/relation_types/view/'.$inference['relation_type_id'], array('class' => $class)));  ?></td>
		<td><?php echo($html->link($inference['to_title'], '/vertices/view/'.$inference['to_id'], array('class' => $class))); ?></td>
<?php		if ($auth->sessionValid()) : ?>
<?php
				//prepare some data
				$htmlid = 'possible_inference_'.$inference['from_id'].'_'.$inference['relation_type_id'].'_'.$inference['to_id'];
?>
		<td class="center" id="<?php echo $htmlid; ?>"><?php
				if ($inference['exists']) echo $html->image('icons/icon_ok.png', array('width' => 16, 'height' => 16, 'alt' => __('Inference exists', true), 'title' => __('Inference exists', true)));
				else {
					$options = array('controller' => 'relations',
						'action' => 'add_inference',
						$relation['Relation']['id'],
						'from_id' => $inference['from_id'],
						'relation_type_id' => $inference['relation_type_id'],
						'to_id' => $inference['to_id']);
					echo $ajax->link($html->image('icons/icon_add.png', array('width' => 16, 'height' => 16, 'alt' => __('Add', true), 'title' => __('Add', true), 'id' => $htmlid.'img')),
						$options,
						array('update' => $htmlid, 'url' => $options, 'before' => '$('."'".$htmlid."'".').innerHTML = '."'<img src=\"/img/ajax-loader.gif\">';"),
						null, false);
				} 
				//;
		?></td>
<?php 		endif; ?>
	</tr>
<?php		endforeach; ?>
</table>
</div>
<?php endif; ?>