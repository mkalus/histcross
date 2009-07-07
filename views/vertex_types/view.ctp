<?
/*********************************************************
 * histcross v2.0
 * File: view.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
//define model array
$model_array =  array('data' => $vertexType, 'model' => 'VertexType', 'linkbibs' => false);
?>
<div class="viewentry">
	<div class="vertexTypes view">
		<h2><?php
			echo $hcSupport->createIconandEditLink($vertexType['VertexType']['id'],
				'icon_vertextype.gif',
				 __('Vertex Type', true)).
				 $hcSupport->getIconHTML($vertexType['VertexType']['pictogram_id'], true).
				 Sanitize::html($vertexType['VertexType']['title']);?><br />
<?
$classlink = $html->link(
	$vertexType['VertexClass']['title'],
	array(
		'controller'=>'vertex_classes',
		'action'=>'view',
		$vertexType['VertexClass']['id']
	)
);
?>
			<span style="font-size:smaller;"><?php  __('Vertex Type'); printf(__(' of the Class %s', true), $classlink); ?></span>
		</h2>
		
		<dl class="dataentry">
<?
//Show comment element
echo $this->element('view_comment', $model_array);
//Show geo/date allowed element
echo $this->element('view_geodate', $model_array);
?>
		</dl>
	</div>
<?
//Show related vertices
echo $this->element('list_vertices', array('elementtitle' => 'Related Vertices', 'useajax' => true));

//Add Footer
echo $this->element('footer_editinfo', $model_array);
?>
</div>
