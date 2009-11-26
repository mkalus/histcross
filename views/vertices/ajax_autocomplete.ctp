<?php
/*********************************************************
 * histcross v2.0
 * File: ajax_autocomplete.ctp
 * Created: 09.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
?>
<ul class="autocomplete_live">
<?php foreach($vertices as $vertex) : ?>
<?
$pic = $vertex['Vertex']['pictogram_id'];
if (!is_numeric($pic)) $pic = '';
else {
	$pic = $hcSupport->getIconHTML($pic, false);
}
?>
<li id="<?php echo($vertex['Vertex']['id']); ?>"><?php echo($pic.Sanitize::html($vertex['Vertex']['title'])); ?></li>
<?php endforeach; ?>
</ul>