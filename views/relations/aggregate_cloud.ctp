<?php
/*********************************************************
 * histcross v2.0
 * File: aggregate_cloud.ctp
 * Created: 15.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

?>
<h2><?php __('Relational Tag Clouds');?></h2>

<h3><?php __('Popular &quot;From&quot;-Vertices');?></h3>
<div class="tagcloud">
<?
$cloud = $tagcloud->shuffleTags($tagcloud->formulateTagCloud($fromtags));
?>
<? foreach($cloud as $entry => $values) : ?>
<?=$html->link($entry, array('controller' => 'vertices', 'action' => 'view', $fromids[$entry]), array('style' => 'font-size: '.$values['size'].'%;'));?>
<? endforeach; ?>
</div>

<h3><?php __('Popular &quot;To&quot;-Vertices');?></h3>
<div class="tagcloud">
<?
$cloud = $tagcloud->shuffleTags($tagcloud->formulateTagCloud($totags));
?>
<? foreach($cloud as $entry => $values) : ?>
<?=$html->link($entry, array('controller' => 'vertices', 'action' => 'view', $toids[$entry]), array('style' => 'font-size: '.$values['size'].'%;'));?>
<? endforeach; ?>
</div>
