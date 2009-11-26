<?php
/*********************************************************
 * histcross v2.0
 * File: view.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//define model array
$model_array =  array('data' => $vertex, 'model' => 'Vertex', 'linkbibs' => true);

//define links
$typelink = $html->link(
	$vertex['VertexType']['title'],
	array(
		'controller'=>'vertex_types',
		'action'=>'view',
		$vertex['VertexType']['id']
	)
);
$classlink = $html->link(
	$vertex['VertexType']['VertexClass']['title'],
	array(
		'controller'=>'vertex_classes',
		'action'=>'view',
		$vertex['VertexType']['VertexClass']['id']
	)
);
?>
<div class="viewentry">
	<div class="vertices view">
		<h2><?php
			echo $hcSupport->createIconandEditLink($vertex['Vertex']['id'],
				'icon_vertex.gif',
				 __('Vertex', true)).
				 $hcSupport->getIconHTML($vertex['Vertex']['pictogram_id'], true).
				 Sanitize::html($vertex['Vertex']['title']);?><br />
			<span style="font-size:smaller;"><?php  __('Vertex'); printf(__(' of the Type %s of the Class %s', true), $typelink, $classlink); ?></span>
		</h2>
		
		<dl class="dataentry">
<?php
//Show time element
echo $this->element('view_time', $model_array);
//Show coordinate element
echo $this->element('view_coordinates', $model_array);
//Show comment element
echo $this->element('view_comment', $model_array);
?>
		</dl>
	</div>

<?php
//Add the bibliography list
echo $this->element('view_bibliography_list', array('bibliographies' => $vertex['Bibliography'], 'id' => $vertex['Vertex']['id'], 'model' => 'Vertex'));

//Add the set information list
echo $this->element('view_tagset_list', array('tagsets' => $vertex['Tagset'], 'id' => $vertex['Vertex']['id']));

//Show related relations
echo $this->element('list_relations', array('elementtitle' => __('Related Relations', true), 'useajax' => true));

//Show Dropdown for possible Relations
if ($auth->sessionValid()) : ?>
<div class="smallinputline">
<h3><?php __('Add New Relation to this Vertex'); ?></h3>
<?php
	echo $form->create('Relation', array('type' => 'get'));
	
	echo $form->hidden('vertex_id', array('value' => $vertex['Vertex']['id']));
	echo $form->select('possible_relation', $relation_types, null, array('class' => 'smallinlineinput', 'onChange' => "\$('RelationAddForm').submit();"), __('--- select ---', true));
	
	echo $form->end(__('Add!', true), array('class' => 'smallinlineinput'));
?>
</div>
<?php endif;

//Add Java element
echo '<a name="visualized_network"></a>';
	//Has showglobe been set?
	if ($session->read('VertexViewNetworkApplet') == '1' ||
		(isset($this->params['named']['viewnetworkapplet']) &&
			$this->params['named']['viewnetworkapplet'] == 'yes')) {
		echo $this->element('view_network_applet', array('vertex_id' => $vertex['Vertex']['id'], 'hostname' => $hostname));
	} else {
?>
<div id="viewnetworkapplet"><p><?php
		echo $ajax->link(
			__('Activate interactive network view', true),
			array(
				'controller' => Inflector::tableize($model),
				'action'=>'view',
				$vertex['Vertex']['id'],
				'viewnetworkapplet' => 'yes'
			),
    		array(
				'url' => array( 'controller' => Inflector::tableize($model),
					'action' => 'view',
    				$vertex['Vertex']['id'],
    				'viewnetworkapplet' => 'yes'
    		),
				'before' => "Element.show('networkapplet_loading');",
				'complete' => "Element.hide('networkapplet_loading');",
				'update' => 'viewnetworkapplet'
			),
    		null,
    		false
		);
?><br /><?php __('The active network view lets you view nodes interactively. This feature needs Java enabled.'); ?></p></div>
<?php
		echo '<div id="networkapplet_loading" style="display:none;">';
		echo $html->image('ajax-loader.gif');
		echo '</div>';
	}

//Add Footer
echo $this->element('footer_editinfo', $model_array);
?>
</div>
