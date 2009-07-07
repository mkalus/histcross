<?php
/*********************************************************
 * histcross v2.0
 * File: index.ctp
 * Created: 15.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
?>
<div class="tagsets index">
<h2><?php __('Tag Sets');?></h2>

<div class="tagsetlist">
<? $lastheader = -1;
   foreach($tagsets as $tagset) : ?>
<?
		$header = $tagset['Tagset']['group'];
		if ($header != $lastheader) {
			if ($lastheader != -1) echo '</ul>';
			echo '<h3>'.Sanitize::html($header).'</h3><ul>';
			$lastheader = $header; 
		}
		echo '<li>'.$html->link($tagset['Tagset']['title'], array('action' => 'view', $tagset['Tagset']['id'])).'</li>';
?>
<? endforeach; ?>
</ul></div>

<h2><?php __('Tag Cloud');?></h2>
<div class="tagcloud">
<?
$cloud = $tagcloud->shuffleTags($tagcloud->formulateTagCloud($tags));
?>
<? if (count($cloud) > 0) foreach($cloud as $entry => $values) : ?>

<?=$html->link($entry, array('action' => 'view', $idlist[$entry]), array('style' => 'font-size: '.$values['size'].'%;'));?>
<? endforeach; ?>
</div>
</div>
