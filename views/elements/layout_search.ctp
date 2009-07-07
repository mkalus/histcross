<?php
/*********************************************************
 * histcross v2.0
 * File: layout_search.ctp
 * Created: 11.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//defined?
if (isset($this->params['url']['s']))
	$s = $this->params['url']['s'];
else $s = '';

echo $form->create('search', array('type' => 'get', 'action' => 'search', 'class' => 'searchbox'));
echo $form->text('s', array('type' => 'text', 'value' => $s));
echo $form->submit(__('Search!', true));
echo $form->end();
?>