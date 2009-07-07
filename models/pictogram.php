<?php
/*********************************************************
 * histcross v2.0
 * File: pictogram.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class Pictogram extends AppModel {
	var $actsAs = array('Containable');

	var $name = 'Pictogram';
	var $validate = array(
		'title' => array('notempty'),
		'picture' => array(
			'extension' => array(
				'rule' => array('extension', array('', 'gif', 'jpeg', 'png', 'jpg')),
				'message' => 'Only gif, jpg, and png-Files are allowed.'
			),
			'isUploadedFile' => array(
				'rule' => 'isUploadedFile',
				'message' => 'Please submit a picture',
				'on' => 'create'
			),
		)
	);


	// Based on comment 8 from: http://bakery.cakephp.org/articles/view/improved-advance-validation-with-parameters
	function isUploadedFile($params){
		$val = array_shift($params);
		if ((isset($val['error']) && $val['error'] == 0) ||
		(!empty($val['tmp_name']) && $val['tmp_name'] != 'none')) 
		{
			return is_uploaded_file($val['tmp_name']);
		} else {
			return false;
		}
	} 

	/**
	 * Prepare uploaded data
	 */
	function beforeSave() {
		if ($this->data['Pictogram']['picture']['error'] == 0 &&
			$this->data['Pictogram']['picture']['tmp_name'] != '')
		{
			//convert filename into safe name
			list($filename, $ext) = $this->splitFilenameAndExt($this->data['Pictogram']['picture']['name']);
			$filename = Inflector::slug($filename).'.'.$ext;
			//set this name again
			$this->data['Pictogram']['picture']['name'] = $filename;
			
			$saveAs = APP.'webroot'.DS.'img'.DS.'tempimages'.DS.$filename;

			if(!move_uploaded_file($this->data['Pictogram']['picture']['tmp_name'], $saveAs)){
				$model->validationErrors['picture'] = __('Could not move the temporary picture ito process it further.', true);
				return false;
			}

		}
		return true;
	}

	/**
	 * Splits a filename in two parts: the name and the extension. Returns an array with it respectively.
	 * 
	 * @author Vinicius Mendes
	 * @return Array
	 * @param $filename String
	 */
	function splitFilenameAndExt($filename){
		$parts = explode('.',$filename);
		$ext = $parts[count($parts)-1];
		unset($parts[count($parts)-1]);
		$filename = implode('.',$parts);
		return array($filename,$ext);
	}

	/**
	 * Work with the uploaded data
	 */
	function afterSave($created) {
		//Figure out id
		if ($created) $myid = $this->getLastInsertID();
		else $myid = $this->data['Pictogram']['id'];

		//new picture was uploaded
		if ($this->data['Pictogram']['picture']['error'] == 0 &&
			$this->data['Pictogram']['picture']['tmp_name'] != '') {
			$src_pic = APP.'webroot'.DS.'img'.DS.'tempimages'.DS.$this->data['Pictogram']['picture']['name'];
			$dst_folder = APP.'webroot'.DS.'img'.DS.'pictograms'.DS;
			
			//Check image magic
			$im = Configure::read('HC.convert_path');
			if (file_exists($im) && is_executable($im)) {
				//Sizes
				$bigsize = Configure::read('HC.pictogram_big');
				$smallsize = Configure::read('HC.pictogram_big');
				if ($bigsize == '') $bigsize = '24x24';
				if ($smallsize == '') $smallsize = '16x16';
				//Create icons
				echo exec($im.' '.$src_pic.' -resize '.$smallsize.' '.$dst_folder.'s'.$myid.'.png');
				echo exec($im.' '.$src_pic.' -resize '.$bigsize.' '.$dst_folder.'b'.$myid.'.png');
			}

			//Delete source picture
			unlink($src_pic);
		}
	}
	
	/**
	 * also delete pics
	 */
	function beforeDelete() {
		$folder = APP.'webroot'.DS.'img'.DS.'pictograms'.DS;
		$myid = $this->data['Pictogram']['id'];
		
		unlink($folder.'s'.$myid.'.png');
		unlink($folder.'b'.$myid.'.png');
		return true;
	}
}
?>