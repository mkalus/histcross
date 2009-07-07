<?php
/*********************************************************
 * histcross v2.0
 * File: inference_type.php
 * Created: 12.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class InferenceType extends AppModel {
	var $actsAs = array('Containable');

	var $name = 'InferenceType';
	var $validate = array(
		'is_xy' => array('numeric'),
		'connects' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Inference' => array('className' => 'Inference',
								'foreignKey' => 'inference_type_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);

}
?>