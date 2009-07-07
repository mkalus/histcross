<?php
/*********************************************************
 * histcross v2.0
 * File: list_inferences.ctp
 * Created: 12.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
?>
<? //only display list if Inferences exist - and if user is logged in
   if ($auth->sessionValid() || (is_array($inferences) && count($inferences) > 0)) : ?>
<h2>
<?
		//new inference icon
		if ($auth->sessionValid()) {
    		//Check Access
    		if (AccessKeeper::checkAccess('inferences', 'add', $auth->user('group'))) {
    			echo $html->link(
    				$html->image(
						'icons'.DS.__('icon_new_en.gif', true),
						array('width' => '32', 'height' => '16')
					),
					array(
						'controller'=>'inferences',
						'action'=>'add',
						'relation_type'=>$id
					),
					array('title' => __('New', true)),
					false,
					false
				).' ';
    		}
		}
?>
<? __('Inferences'); ?>
<? echo $html->image('icons'.DS.'icon_addsmall.png', array('width' => '22', 'height' => '22', 'title' => __('Show more', true), 'id' => 'inferencelistadd', 'onClick' => "showInferenceList();")); ?>
<? echo $html->image('icons'.DS.'icon_removesmall.png', array('width' => '22', 'height' => '22', 'title' => __('Show less', true), 'id' => 'inferencelistremove', 'onClick' => "hideInferenceList();")); ?>
</h2>
<? endif; ?>
<? //only display list if Inferences exist
   if (is_array($inferences) && count($inferences) > 0) : ?>
<table class="inferencelist" id="tableinferencelist">
<?
	if ($auth->sessionValid() && AccessKeeper::checkAccess('inferences', 'edit', $auth->user('group')))
		$editauth = true;
	else $editauth = false;
?>
<?	foreach($inferences as $inference) : ?>
<?
		//prepare the formula
		if ($inference['InferenceType']['is_xy'] == 1) $a = 'x'; else $a = 'y';
		$b = substr($inference['InferenceType']['connects'], 1, 1);
		
		$c = substr($inference['InferenceType']['connects'], 0, 1);
		
		$formula = Sanitize::html($inference['RelationType1']['title_from'].
			($inference['Inference']['p1_dir_from']==1?'(x,y)':'(y,x)').
			' ∧ '.$inference['RelationType2']['title_from'].
			($inference['Inference']['p2_dir_from']==1?"($a,$b)":"($b,$a)").
			' ⇒ '.$inference['RelationType3']['title_from'].
			($inference['Inference']['p3_dir_from']==1?"($c,$b)":"($b,$c)"));
?>
	<tr>
		<td class="inference_maps"><? echo $html->image('inferences'.DS.'inference_'.$inference['InferenceType']['img'].'.png', array('width' => 142, 'height' => 142, 'alt' => $inference['InferenceType']['comment'], 'title' => $inference['InferenceType']['comment'])); ?></td>
		<td>
		<div class="inference_formula">
		<span><? __('Formula:'); ?></span><br />
<?
		//edit icon
		if ($editauth) {
			echo $html->link(
				$html->image(
					'icons'.DS.'icon_editsmall.gif',
					array('width' => '16', 'height' => '16')
				),
				array(
					'controller'=>'inferences',
					'action'=>'edit',
					$inference['Inference']['id']
				),
				array('title' => __('Edit', true)),
				false,
				false
			).' ';
		}
?>
		<? echo $formula; ?>
		</div>
		<div class="inference_maps">
			<div class="inference_box">a = <span class="relationtype"><? echo Sanitize::html($inference['Inference']['p1_dir_from']==1?$inference['RelationType1']['title_from'].' ►':$inference['RelationType1']['title_to'].' ◄')?></span></div>
			<div class="inference_box">b = <span class="relationtype"><? echo Sanitize::html($inference['Inference']['p2_dir_from']==1?$inference['RelationType2']['title_from'].' ►':$inference['RelationType2']['title_to'].' ◄')?></span></div>
			<div class="inference_box">c = <span class="relationtype"><? echo Sanitize::html($inference['Inference']['p3_dir_from']==1?$inference['RelationType3']['title_from'].' ►':$inference['RelationType3']['title_to'].' ◄')?></span></div>
		</div>
		</td>
	</tr>
<?	endforeach; ?>
</table>
<? endif; ?>
<? echo $javascript->codeBlock('hideInferenceList();', array('inline' => true)); ?>
