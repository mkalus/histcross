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
$model_array =  array('data' => $relationClass, 'model' => 'RelationClass', 'linkbibs' => false);
?>
<div class="viewentry">
	<div class="relationclass view">
		<h2><?php
			echo $hcSupport->createIconandEditLink($relationClass['RelationClass']['id'],
				'icon_relationclass.gif',
				 __('Relation Class', true)).
				 Sanitize::html($relationClass['RelationClass']['title']);?><br />
			<span style="font-size:smaller;"><?php  __('Relation Class');?></span>
		</h2>
		
	<?php if ($relationClass['RelationClass']['comment'] != '') : ?>
		<dl class="dataentry">
<?php
//Show comment element
echo $this->element('view_comment', $model_array);
?>
		</dl>
	<?php endif ?>
	</div>

<?php
//Show related relation types
echo $this->element('list_relation_types', array('elementtitle' => __('Related Relation Types', true), 'useajax' => true));

//Add Footer
echo $this->element('footer_editinfo', $model_array);
?>
</div>
