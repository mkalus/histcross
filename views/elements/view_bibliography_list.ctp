<?
/*********************************************************
 * histcross v2.0
 * File: view_bibliography_list.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

$bookimg = $html->image('icons'.DS.'icon_booksmall.gif', array('width' => '16', 'height' => '16', 'title' => __('Details', true), 'alt' => __('Details', true)));
?>
	<div id="bibliography_list">
<? if (count($bibliographies) > 0 || $auth->sessionValid()) : ?>
		<div id="bibliography_loading" class="ajaxloaderright" style="display: none;"><?=$html->image('ajax-loader.gif')?></div>
		<h3><? __('Bibliography'); ?></h3>
<? endif; ?>
<? 	if ($session->check('Message.bib')):
		$session->flash('bib');
	endif; ?>
<? if (count($bibliographies) > 0) :
	foreach($bibliographies as $bibliography) : ?>
		<div class="bibliography_entry">
<?=$html->link($bookimg, '/bibliographies/view/'.$bibliography['id'], array(), false, false);?>
<?		//prepare nice title
		echo $html->link($bibliography['shorttitle'], '/bibliographies/view/'.$bibliography['id']);
		//Now, how are pages presented?
		if ($bibliography['Bibliographies'.$model]['pages'] != '')
			echo ',';
		if (!$auth->sessionValid()) { // not logged in -> simply echo them
			echo ' '.$bibliography['Bibliographies'.$model]['pages'];
		} else { //logged in: create edit field
			echo '<div id="bibpages_'.$bibliography['id'].'" class="bibliography_page">'.
				$bibliography['Bibliographies'.$model]['pages'];
			echo $html->image( 'icons'.DS.'icon_editsmall.gif',
						array('width' => '16', 'height' => '16', 'title' => __('Edit', true), 'alt' => __('Edit', true))
					);
			echo '</div>';
			//Create Ajax edit action
			echo $ajax->editor('bibpages_'.$bibliography['id'], array(
				//'controller' => Inflector::tableize($model),
				'action' => 'edit_bibliography',
				$id,
				'bib' => $bibliography['Bibliographies'.$model]['id']
			));
			//Delete image
			echo $ajax->link($html->image( 'icons'.DS.'icon_delete.gif',
						array('width' => '16', 'height' => '16', 'title' => __('Delete', true), 'alt' => __('Delete', true))
					), array(
						'controller' => Inflector::tableize($model),
						'action' => 'delete_bibliography',
						$id,
						'bib' => $bibliography['Bibliographies'.$model]['id']),
					array(
						'url' => array(
							'controller' => Inflector::tableize($model),
							'action' => 'delete_bibliography',
							$id,
							'bib' => $bibliography['Bibliographies'.$model]['id']
						),
						'title' => __('Delete', true),
						'before' => "Element.show('bibliography_loading');",
						'complete' => "Element.hide('bibliography_loading');",
						'update' => 'bibliography_list'
					), __('Really delete?', true), false);
		}
?>
		</div>
<? 	endforeach; ?>
<? endif; ?>
<? if ($auth->sessionValid()) : ?>
		<div id="bibliography_formshowbutton"><?=$html->image('icons'.DS.'icon_add.png', array('width' => '32', 'height' => '32', 'title' => __('Add Bibliography', true), 'onClick' => "\$('bibliography_addform').show();\$('bibliography_formshowbutton').hide();"))?></div>
		<div class="bibliographies smallinputline form" id="bibliography_addform" style="display: none;">
<?php echo $ajax->form(array('controller' => Inflector::tableize($model), 'action' => 'add_bibliography', $id),
		'post', array('url' => array(
			'controller' => Inflector::tableize($model),
			'action' => 'add_bibliography', $id),
			'before' => "Element.show('bibliography_loading');",
			'complete' => "Element.hide('bibliography_loading');",
			'update' => 'bibliography_list'));?>
<?php $selectedid = $session->check('bib_id')?$session->read('bib_id'):null;
 echo __('Bibliography:', true).' '.$form->select('bibliography_id', $bibliography_list, $selectedid, array('class' => 'smallinlineinput'), false);?>
<?php echo ' '.__('Pages:', true).' '.$form->text('pages', array('class' => 'smallinlineinput', 'value' => ($session->check('bib_pages')?$session->read('bib_pages'):'')));?>
<?php echo ' '.$form->submit(__('Add!', true), array('class' => 'smallinlineinput'));?>
<?php echo $form->end(null);?>
		</div>
<? endif; ?>
	</div>