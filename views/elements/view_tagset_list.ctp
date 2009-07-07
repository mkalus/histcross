<?php
/*********************************************************
 * histcross v2.0
 * File: view_tagset_list.ctp
 * Created: 15.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//boolean to show form...
if (!isset($showform)) $showform = false;
$setimg = $html->image('icons'.DS.'icon_set.gif', array('width' => '16', 'height' => '16', 'title' => __('Details', true), 'alt' => __('Details', true)));
?>
	<div id="tagset_list">
<? if (count($tagsets) > 0 || $auth->sessionValid()) : ?>
		<div id="tagset_loading" class="ajaxloaderright" style="display: none;"><?=$html->image('ajax-loader.gif')?></div>
		<h3><? __('Associated Sets'); ?></h3>
<? endif; ?>
<? if ($session->check('Message.tagset')):
		$session->flash('tagset');
   endif; ?>
<? if (count($tagsets) > 0) :
	foreach($tagsets as $tagset) :
		//from Ajax?
		if (isset($tagset['Tagset'])) {
			$tagset['id'] = $tagset['Tagset']['id'];
			$tagset['title'] = $tagset['Tagset']['title'];
			$tagset['group'] = $tagset['Tagset']['group'];
		}
		
		//prepare title
		if ($tagset['group'] != '') $tagset['title'] = $tagset['group'].':'.$tagset['title'];
?>
		<div class="tagset_entry">
<?=$html->link($setimg.' '.Sanitize::html($tagset['title']), '/tagsets/view/'.$tagset['id'], array(), false, false);?>
<?
		//Logged in - prepare a delete action
		if ($auth->sessionValid()) {
			//Delete image
			echo $ajax->link($html->image( 'icons'.DS.'icon_delete.gif',
						array('width' => '16', 'height' => '16', 'title' => __('Delete', true), 'alt' => __('Delete', true))
					), array(
						'controller' => 'tagsets',
						'action' => 'delete_set',
						$tagset['TagsetsVertex']['id'],
						'vtx' => $id),
					array(
						'url' => array(
							'controller' => 'tagsets',
							'action' => 'delete_set',
							$tagset['TagsetsVertex']['id'],
							'vtx' => $id
						),
						'title' => __('Delete', true),
						'before' => "Element.show('tagset_loading');",
						'complete' => "Element.hide('tagset_loading');",
						'update' => 'tagset_list'
					), __('Really delete?', true), false);
		}
?>
		</div>
<? 	endforeach; ?>
<? endif; ?>
<? if ($auth->sessionValid()) : ?>
		<div id="tagset_formshowbutton"><?
		if (!$showform)
			echo $html->link(
				$html->image('icons'.DS.'icon_add.png',
					array('width' => '32', 'height' => '32',
						'title' => __('Add Bibliography', true))),
					array('controller' => 'tagsets', 'action' => 'add_set', $id),
					array('onClick' => "\$('tagset_addform').show();\$('tagset_formshowbutton').hide(); return false;"),
					false, false);
		?></div>
		<div class="tagsets smallinputline smallline form" id="tagset_addform"<? if (!$showform) : ?> style="display: none;"<? endif; ?>>
<?php echo $ajax->form(array('controller' => 'tagsets', 'action' => 'add_set', $id),
		'post', array('url' => array(
			'controller' => 'tagsets',
			'action' => 'add_set', $id),
			'before' => "Element.show('tagset_loading');",
			'complete' => "Element.hide('tagset_loading');",
			'update' => 'tagset_list'));?>
<?php __('Add new set name below. Classification of sets can be achieved by using the schema &quot;class:setname&quot;.'); ?><br />
<?php //echo ' '.__('New Set:', true).' '.$form->text('Tagset.title', array('class' => 'smallinlineinput wider', 'value' => ''));?>
<?php echo ' '.__('New Set:', true).' '.$ajax->autoComplete('Tagset.title', '/tagsets/ajax_autocomplete', array('class' => 'smallinlineinput wider', 'value' => ''));?>
<?php //echo $strictAutocomplete->autoComplete('relation_to_vertex', '/vertices/ajax_autocomplete', array('label'=>'To Vertex', 'strict'=>true, 'callback' => 'function(element, entry) { return entry + "&direction=to&relationType=" + $("RelationRelationTypeId").value; }')); ?>
<?php echo $form->input('Tagset.vertex_id', array('type' => 'hidden', 'value' => $id)); ?>
<?php echo ' '.$form->submit(__('Add!', true), array('class' => 'smallinlineinput'));?>
<?php echo $form->end(null);?>
		</div>
<? endif; ?>
	</div>