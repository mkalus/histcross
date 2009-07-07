<?php
/*********************************************************
 * histcross v2.0
 * File: multi_checkbox.php
 * Created: 09.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

if (!class_exists('Sanitize')) App::import('Sanitize');

class MultiCheckboxHelper extends Helper {
	var $helpers = array('Html');
	
	function multiCheckBox($valueField, $model, $column, $data = null, $title = null) {
		$out = '';
		
		//sanitize data
		if (!$data) $data = array(); //empty default
		elseif (!is_array($data)) {
			$set = split(',', $data);
			$data = array();
			for ($i = 0; $i < count($set); $i++)
				$data[$set[$i]] = 1;
		}
		
		$idname = $model.Inflector::camelize($column);
		if ($title) $out .= '<label for="'.$idname.'" class="multiCheckboxLabel">'.Sanitize::html($title).'</label>';
		$out .= '<div id="'.$column.'_multiCheckbox" class="multiCheckbox">';
		
		foreach($valueField as $key => $val) {
			if (isset($data[$key]) && $data[$key] == 1) $selected = ' checked="checked"';
			else $selected = '';
			
			$out .= '<div>' .
					'<input type="hidden" name="data['.$model.']['.$column.']['.$key.']" id="'.$idname.$key.'_" value="0" />' .
					'<input type="checkbox" name="data['.$model.']['.$column.']['.$key.']" value="1" id="'.$idname.$key.'"'.$selected.' /> ' .
					Sanitize::html($val).'</div>';
		}

		$out .= '</div>';
		
		return $out;
     }
}
?>
