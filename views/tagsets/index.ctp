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
<?php $lastheader = -1;
   foreach($tagsets as $tagset) : ?>
<?php
		$header = $tagset['Tagset']['group'];
		if ($header != $lastheader) {
			if ($lastheader != -1) echo '</ul>';
			echo '<h3>'.Sanitize::html($header).'</h3><ul>';
			$lastheader = $header; 
		}
		echo '<li>'.$html->link($tagset['Tagset']['title'], array('action' => 'view', $tagset['Tagset']['id'])).'</li>';
?>
<?php endforeach; ?>
</ul></div>

<h2><?php __('Tag Cloud');?></h2>
<div class="tagcloud">
<?php
$cloud = $tagcloud->shuffleTags($tagcloud->formulateTagCloud($tags));
?>
<?php if (count($cloud) > 0) foreach($cloud as $entry => $values) : ?>

<?php echo($html->link($entry, array('action' => 'view', $idlist[$entry]), array('style' => 'font-size: '.$values['size'].'%;')));?>
<?php endforeach; ?>
</div>
</div>
