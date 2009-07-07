<?php
/*********************************************************
 * histcross v2.0
 * File: app_model.php
 * Created: 29.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class AppModel extends Model {

	function invalidate($field, $value = true) {
		return parent::invalidate($field, __($value, true));
	}
}
?>
