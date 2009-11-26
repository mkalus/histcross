<?php
/*********************************************************
 * histcross v2.0
 * File: view_comment.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

/**
 * Comment view element
 * $data should be set
 * $model should be set, too
 * $linkbibs should be set to true or false
 */

if (!isset($linkbibs)) $linkbibs = false;
?>
<?php if ($data[$model]['comment'] != '') : ?>
			<dt class="comment"><?php  __('Comment');?></dt>
			<dd class="comment"><?php echo $hcFormat->format($data[$model]['comment'], $linkbibs); ?></dd>
<?php endif ?>
