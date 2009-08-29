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
$model_array =  array('data' => $relation, 'model' => 'Relation', 'linkbibs' => true);

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
		<h2><?php
			echo $hcSupport->createIconandEditLink($relation['Relation']['id'],
				'icon_relation.gif',
				 __('Relation', true)).
				 $from_object_icon.' '.$from_object_link.' &rArr; '.
				 $type_icon.' '.$type_link.' &rArr; '.
				 $to_object_icon.' '.$to_object_link.' '; ?><br />
			<span style="font-size:smaller;"><?php  __('Relation'); printf(__(' of the Type %s and the Class %s', true), $type_link, $classlink); ?></span>
		</h2>
		
		<dl class="dataentry">
<?
//Show time element
echo $this->element('view_time', $model_array);
//Show coordinate element
echo $this->element('view_coordinates', $model_array);
//Show comment element
echo $this->element('view_comment', $model_array);
?>
		</dl>
	</div>

<?
//Add the bibliography list
echo $this->element('view_bibliography_list', array('bibliographies' => $relation['Bibliography'], 'id' => $relation['Relation']['id'], 'model' => 'Relation'));

//Show related relations
echo $this->element('list_relations', array('elementtitle' => __('Similar Relations from left Vertex', true), 'useajax' => true, 'relations' => $fromsame, 'uniqhandle' => 'from'));
echo $this->element('list_relations', array('elementtitle' => __('Similar Relations to right Vertex', true), 'useajax' => true, 'relations' => $tosame, 'uniqhandle' => 'to'));

//Show link to possible inferences, if logged in
if ($auth->sessionValid()) :
?>
	<div class="possible_inferences" id="possible_inferences">
	<div id="possible_inferences_loading" class="ajaxloaderright" style="display: none;"><?=$html->image('ajax-loader.gif')?></div>
	<h3><? __('Possible Derived Relations'); ?></h3>
	<? echo $ajax->link(__('Show possible derived relations', true),
		array( 'controller' => 'relations', 'action' => 'possible_inferences', $relation['Relation']['id']),
		array('update' => 'possible_inferences', 'url' => array('controller' => 'relations', 'action' => 'possible_inferences', $relation['Relation']['id']), 'before' => "Element.show('possible_inferences_loading');")
		); ?>
	</div>
<?
endif;

//Add Footer
echo $this->element('footer_editinfo', $model_array);
?>
</div>
