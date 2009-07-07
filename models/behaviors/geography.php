<?php
/*********************************************************
 * histcross v2.0
 * File: geography.php
 * Created: 08.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class GeographyBehavior extends ModelBehavior {
	var $lat = null, $lon = null;
	
	function validateCoordinatePair(&$data, &$field) {
		$geo = $field['geo'];
		if ($geo == '') return true; //may be empty
		
		//test geographic data: 1) must be two elements
		$geoarr = split(' ', chop($geo));
		
		$last = count($geoarr)-1;
		
		//two elements???
		if ($last == 0) return false;
		//get them
		$f = $geoarr[0];
		$l = $geoarr[$last];
		
		for($i = 1; $i < $last; $i++)
			if ($geoarr[$i] != '') return false;
		
		//check types
		if (!is_numeric($f)) { //non-numeric format
			//check directions...
			$test = $this->degree2Decimal($f, 'NS');
			if ($test) {
				$this->lat = $test;
				$this->lon = $this->degree2Decimal($l, 'WE');
				if (!$this->lon) return false;
			} else {
				$test = $this->degree2Decimal($f, 'WE');
				if ($test) {
					$this->lon = $test;
					$this->lat = $this->degree2Decimal($l, 'NS');
					if (!$this->lat) return false;
				} else return false;
			}
		} else {
			$this->lat = $f;
			$this->lon = $l;
			if (!is_numeric($this->lon)) return false;
		}
		//adjust coordinates
		if ($this->lat > 180 || $this->lat < -180) $this->lat = $this->lat % 180;
		if ($this->lon > 90 || $this->lon < -90) $this->lon = $this->lon % 90;
		
		return true;
	}


	/**
	 * Calculate degree dd:mm:ssN to decimal degree
	 */
	function degree2Decimal($coord, $type) {
		//test types
		if ($type == 'NS' && !preg_match('/^[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}[NSns]/', $coord)) return false;
		if ($type != 'NS' && !preg_match('/^[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}[WEweOo]/', $coord)) return false;

		//split
		$direction = strtoupper(substr($coord, -1));
		$coordinates = split(':', substr($coord, 0, -1));
		
		$decimal = (float) $coordinates[0];
		$decimal += ((float) $coordinates[1])/60;
		$decimal += ((float) $coordinates[2])/3600;
		
		if (($direction=="S") or ($direction=="W")) {
			$decimal *= -1;
		}
		
		return $decimal;
	}
	
	function beforeSave(&$model) {
		if (is_numeric($this->lat) && is_numeric($this->lon))
			$model->data[$model->name]['geo'] = $this->lat.' '.$this->lon;
		else $model->data[$model->name]['geo'] = null;
	}
	
	//xxx -> possible addition of geographic data entries to be formated...
//	function afterSave(&$model, $created) {
//		//Figure out id
//		if ($created) $myid = $model->getLastInsertID();
//		else $myid = $model->data['Pictogram']['id'];
//		
//		//figure out entry of 
//	}
}
?>