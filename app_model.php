<?php
/*********************************************************
 * $Id: app_model.php 93 2008-12-29 21:49:03Z Maximilian Kalus $
 * histcross v2.0
 * File: app_model.php
 * Created: 29.12.2008
 * (c) 2008 Maximilian Kalus
 *********************************************************/

class AppModel extends Model {

	function invalidate($field, $value = true) {
		return parent::invalidate($field, __($value, true));
	}
}
?>
