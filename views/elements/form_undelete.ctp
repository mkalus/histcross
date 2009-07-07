<?php
/*********************************************************
 * histcross v2.0
 * File: form_delete.php
 * Created: 02.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//Only show form element, if deleted...
$mydata = $this->data[Inflector::singularize($this->name)];

if (isset($mydata['deleted']) && $mydata['deleted'] != 0)
	echo $form->input('deleted', array('after' => __('Unset to undelete data entry', true)));
?>