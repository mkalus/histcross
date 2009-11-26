<?php
/*********************************************************
 * histcross v2.0
 * File: view_network.ctp
 * Created: 16.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

if (isset($this->params['named']['shownetwork'])) :
	//prepare data to be worked upon
	$network->prepareData($model, $id, $vertices, $edges);
	//create file
	$filename = $network->buildFile();
	//create better graph file
	$dotfile = $network->createVisualFile('dot');
	//create image
	$img = $network->createNetwork();
?>
			<dt><?php  __('Network Visualization');?></dt>
			<dd><div id="viewnetwork">
				<div id="network_loading" style="display:none;"><?php echo $html->image('ajax-loader.gif'); ?></div>
				<?php echo $html->link($html->image($img['small']),
					'/img/'.$img['big'], array('target' => '_blank'), false, false); ?>
				<br />
				<?php echo $html->link(__('Graphviz Data File', true), '/'.$filename, array('target' => '_blank')); ?>
				<br />
				<?php echo $html->link(__('Coordinated DOT-File', true), '/'.$dotfile, array('target' => '_blank')); ?>
			</div></dd>
<?php else : ?>
			<dt><?php  __('Network Visualization');?></dt>
			<dd><div id="viewnetwork">
<?php
	echo $ajax->link(
		$html->image('icons'.DS.'icon_set.gif',
			array('width' => '16', 'height' => '16',
				'alt' => __('Visualize Network', true),
				'title' => __('Visualize Network', true),
			)
		),
		array(
			'controller' => Inflector::tableize($model),
			'action'=>'view',
			$data[$model]['id'],
			'shownetwork' => 'yes'
		),
		array(
			'url' => array( 'controller' => Inflector::tableize($model),
				'action' => 'viewnetwork', $data[$model]['id']),
			'before' => "Element.show('network_loading');",
			'complete' => "Element.hide('network_loading');",
			'update' => 'viewnetwork'
		),
		null,
		false
	);
?>
				<div id="network_loading" style="display:none;"><?php echo $html->image('ajax-loader.gif'); ?></div>
			</div></dd>
<?php endif ; ?>