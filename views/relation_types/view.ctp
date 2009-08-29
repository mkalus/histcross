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
$model_array =  array('data' => $relationType, 'model' => 'RelationType', 'linkbibs' => false);
?>
<div class="viewentry">
	<div class="relationTypes view">
		<h2><?php
			echo $hcSupport->createIconandEditLink($relationType['RelationType']['id'],
				'icon_relationtype.gif',
				 __('Relation Type', true)).
				 $hcSupport->getIconHTML($relationType['RelationType']['pictogram_id'], true).
				 Sanitize::html($relationType['RelationType']['title_from']);?> &rArr; <? __('X') ?> &rArr; <? echo Sanitize::html($relationType['RelationType']['title_to']);?><br />
<?
$classlink = $html->link(
	$relationType['RelationClass']['title'],
	array(
		'controller'=>'relation_classes',
		'action'=>'view',
		$relationType['RelationClass']['id']
	)
);
?>
			<span style="font-size:smaller;"><?php  __('Relation Type'); printf(__(' of the Class %s', true), $classlink); ?></span>
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
//Show related inferences
echo $this->element('list_inferences', array('id' => $relationType['RelationType']['id'], 'inferences' => $inferences, 'ajax' => false));
//Show related relations
echo $this->element('list_relations', array('elementtitle' => __('Related Relations', true), 'useajax' => true));

//Add Footer
echo $this->element('footer_editinfo', $model_array);
?>
</div>
