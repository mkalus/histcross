<?php
/*********************************************************
 * histcross v2.0
 * File: julian_date.php
 * Created: 08.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class JulianDateBehavior extends ModelBehavior {
	var $startdate = null, $stopdate = null;
	
	function validateStartTime(&$data, &$field) {
		//ignore empty values
		$entry = $field['start_time_entry'];
		if ($entry == '') return true;
		
		//split the date and write it to an array
		$date = null;
		if (!$this->_splitDate($entry, $date, $data->data[$data->name]['start_time_julian'])) return false;

		//Julian Day at minimum value
		$this->startdate = $this->_calcJD($date, true);
		
		return true;
	}
	
	function validateStopTime(&$data, &$field) {
		//ignore empty values
		$entry = $field['stop_time_entry'];
		if ($entry == '') return true;

		//split the date and write it to an array
		$date = null;
		if (!$this->_splitDate($entry, $date, $data->data[$data->name]['stop_time_julian'])) return false;
		
		//Julian Day at maximum value
		$this->stopdate = $this->_calcJD($date, false);
		
		return true;
	}
	
	function _splitDate($date, &$back, $settype) {
		$arrtmp = array_reverse(explode('.', $date));
		//Error
		if (count($arrtmp) > 3) return false;
		
		//Prepare Back Array
		$back = array('year' => null, 'month' => null, 'day' => null, 'julian' => null, 'settype' => 'gregorian'); 

		//manual setting of julian?
		if ($settype == 1) $back['settype'] = 'julian';

		//first the year
		$y = array_shift($arrtmp);
		if (!is_numeric($y)) return false;
		elseif ($y < -4713 || $y > 9999 || $y == 0) return false;
		else { $back['year'] = $y; if ($y <= 1582) $back['julian'] = true; }//everything ok

		//Monat
		if (count($arrtmp) > 0) {
			$m = array_shift($arrtmp);
			if (!is_numeric($m)) return false;
			elseif ($m < 1 || $m > 12 ) return false;
			else { $back['month'] = $m; if ($back['year'] == 1582 && $m > 10) $back['julian'] = false; }//everything ok
		}

		//Tag
		if (count($arrtmp) > 0) {
			$d = array_shift($arrtmp);
			if (!is_numeric($d)) return false;
			else {
				if ($back['month'] == '') $m = 1; //Dummy...
				if ($back['year'] == '') $y = 2000; //Dummy...
				$dim = cal_days_in_month($back['julian'] ? CAL_JULIAN : CAL_GREGORIAN, $m, $y);
				if ($d < 1 || $d > $dim) return false;
				else {
					if ($back['year'] == 1582 && $back['month'] == 10 && $d > 4 && $d < 15 && $back['settype'] == 'gregorian') return false;
					$back['day'] = $d;
					if ($back['year'] == 1582 && $back['month'] == 10 && $d >= 15) $back['julian'] = false;
				}//everything ok
			}
		}

		return true;
	}
	
	function _calcJD($date, $min = true) {
		//set minima/maxima
		if ($date['month'] == null) {
			if ($min) $date['month'] = 1;
			else $date['month'] = 12;
		}
		
		if ($date['day'] == '') {
			if ($min) $date['day'] = 1;
			else {
				if ($date['year'] == '') $date['year'] = 2000; //Dummy
				$date['day'] = cal_days_in_month($date['julian'] ? CAL_JULIAN : CAL_GREGORIAN, $date['month'], $date['year']);
			} 
		}
		
		//now transform to julian date, depending on user settings
		if ($date['settype'] == 'julian') //force julian
			return cal_to_jd(CAL_JULIAN, $date['month'], $date['day'], $date['year']); //force julian calendar
		else return cal_to_jd ($date['julian'] ? CAL_JULIAN : CAL_GREGORIAN, $date['month'], $date['day'], $date['year']); //automatic
	}

	function beforeSave(&$model) {
		//set start and stop times
		$model->data[$model->name]['start_time'] = $this->startdate;
		$model->data[$model->name]['stop_time'] = $this->stopdate;
		//set null values
		if (!isset($model->data[$model->name]['start_time_entry'])) $model->data[$model->name]['start_time_entry'] = null;
		elseif ($model->data[$model->name]['start_time_entry'] == '') $model->data[$model->name]['start_time_entry'] = null;
		if (!isset($model->data[$model->name]['stop_time_entry'])) $model->data[$model->name]['stop_time_entry'] = null;
		elseif ($model->data[$model->name]['stop_time_entry'] == '') $model->data[$model->name]['stop_time_entry'] = null;
		return true;
	}
}
?>