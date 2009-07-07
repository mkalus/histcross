<?php
/*********************************************************
 * histcross v2.0
 * File: form_comment.php
 * Created: 06.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
//dynamic columns
$count = ceil(substr_count($form->value('comment'), "\n") * 1.8);
if ($count < 5) $count = 8;
elseif ($count > 40) $count = 40;
echo $form->input('comment', array('rows' => $count));
?>