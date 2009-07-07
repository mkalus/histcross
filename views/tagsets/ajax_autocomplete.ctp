<?php
/*********************************************************
 * histcross v2.0
 * File: ajax_autocomplete.ctp
 * Created: 16.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

?>
<ul class="autocomplete_live">
<? foreach($tagsets as $tagset) : ?>
<?
	if ($tagset['Tagset']['group'] != '') $title = $tagset['Tagset']['group'].':'.$tagset['Tagset']['title'];
	else $title = $tagset['Tagset']['title'];
?>
<li><?=Sanitize::html($title)?></li>
<? endforeach; ?>
</ul>