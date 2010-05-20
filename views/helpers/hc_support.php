<?php
/*********************************************************
 * histcross v2.0
 * File: hc_helper.php
 * Created: 25.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//Add Access-Keeper
if (!class_exists('Vendor')) App::import('Vendor', 'access_keeper');

class HcSupportHelper extends Helper {
	var $helpers = array('Html', 'Auth');

	/**
	 * Returns HTML for an icon/pictogram
	 * $number -> id of icon/pictogram
	 * $isBig -> true, if big icon shall be shown
	 */
	function getIconHTML($number, $isBig = false) {
		if ($isBig) {
			$myname = 'b';
		} else {
			$myname = 's';
		}
		return $pictogram = $this->Html->image(
			'pictograms/'.$myname.$number.'.png',
			array('alt' => $myname.$number.'.png', 'class' => 'icon_'.$myname)
		);
	}
	
	/**
	 * Method to return formated date in HC-Manner
	 * $value -> String value to show
	 * $ca -> true, if ca-value
	 * $questionable -> true, if questionable value
	 * $isjulian -> true, if force julian date format
	 */
	function dateformat($value, $ca = false, $questionable = false, $isjulian = false, $julianday = 0) {
		if ($value == '') return ''; //empty values
		
		if (substr_count($value, '.') == 2) $myweekday = __('Day of Week: ', true).__(JDDayOfWeek($julianday, 1), true)."; ";
		else $myweekday = '';
		
		//Calculate new Julian Date
		if ($isjulian) {
			$arrtmp = array_reverse(explode('.', $value));
			if (!isset($arrtmp[1])) $arrtmp[1] = '1'; //defaults annehmen
			if (!isset($arrtmp[2])) $arrtmp[2] = '1';
			if ($arrtmp[0] > 1582 || ($arrtmp[0] == 1582 && $arrtmp[1] > 10) || ($arrtmp[0] == 1582 && $arrtmp[1] == 10 && $arrtmp[2] > 4)) {
				$arrtmp = explode('/', jdtogregorian(cal_to_jd(CAL_JULIAN, $arrtmp[1], $arrtmp[2], $arrtmp[0]))); //month/day/year
				$newval = $arrtmp[1].'.'.$arrtmp[0].'.'.$arrtmp[2];
				if ($newval != $value) $value .= ' ['.__('Gregorian: ', true).$newval.']';
			}
		}
		if ($ca) $value = '~'.$value;
		if ($questionable) $value = $value.'?';
		
		return '<span title="'.$myweekday.__('Julian Day: ', true).$julianday.'">'.$value.'</span>';
	}
	
	/**
	 * Returns simple dateformat without HTML wrapping
	 * $value -> String value to show
	 * $ca -> true, if ca-value
	 * $questionable -> true, if questionable value
	 */
	function dateformatsimple($value, $ca = false, $questionable = false) {
		if ($value == '') return ''; //empty values

		if ($ca) $value = '~'.$value;
		if ($questionable) $value = $value.'?';

		return $value;
	}
	
	/**
	 * Creates an edit link, if user may edit this entity
	 */
	function createIconandEditLink($id, $icon = 'icon_object.gif', $icontitle = null) {
		//first, create icon
		if (!$icontitle) $icontitle = $this->params['controller'];
		$img = $this->Html->image(
			'icons/'.$icon,
			array('width' => '16', 'height' => '16', 'title' => $icontitle)
		);
		//now create edit icon, if applicable
		if ($this->Auth->sessionValid()) {
    		//Check Access
     		if (AccessKeeper::checkAccess(Inflector::classify($this->params['controller']), 'edit', $this->Auth->user('group'))) {
    			$img .= $this->Html->link(
    				$this->Html->image(
						'icons/icon_edit.png',
						array('width' => '16', 'height' => '16')
					),
					array(
						'action'=>'edit',
						$id
					),
					array('title' => __('Edit', true)),
					false,
					false
				);
    		}
		}
		return $img.' ';
	}
}
?>
