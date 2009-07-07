<?php
/*********************************************************
 * histcross v2.0
 * File: creator_changer.php
 * Created: 15.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

if (!class_exists('CakeSession')) App::import('Session');


class CreatorChangerBehavior extends ModelBehavior {
	function beforeSave(&$model) {
		//avoid breaking the whole system...
		if (!isset($GLOBALS['_USERID']) || !is_numeric($GLOBALS['_USERID'])) return true;
		
		//changed or created?
		if(!isset($model->data[$model->name]['id'])) {
			$model->data[$model->name]['creator_id'] = $GLOBALS['_USERID'];
		}
		$model->data[$model->name]['changer_id'] = $GLOBALS['_USERID'];
		return true;
	}
}
?>