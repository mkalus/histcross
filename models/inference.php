<?php
/*********************************************************
 * histcross v2.0
 * File: inference.php
 * Created: 12.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class Inference extends AppModel {
	var $actsAs = array('Containable', 'CreatorChanger');

	var $name = 'Inference';
	var $validate = array(
		'creator_id' => array('numeric'),
		'changer_id' => array('numeric'),
		'deleted' => array('numeric'),
		'p1_id' => array('numeric'),
		'p1_dir_from' => array('numeric'),
		'p2_id' => array('numeric'),
		'p2_dir_from' => array('numeric'),
		'p3_id' => array('numeric'),
		'p3_dir_from' => array('numeric'),
		'inference_type_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Creator' => array(
				'className'  => 'User',
				'foreignKey' => 'creator_id',
				'conditions' => 'Creator.deleted = 0',
				'fields'     => array('id', 'name') 
			),
			'Changer' => array(
				'className'  => 'User',
				'foreignKey' => 'changer_id',
				'conditions' => 'Changer.deleted = 0',
				'fields'     => array('id', 'name') 
			),
			'RelationType1' => array('className' => 'RelationType',
								'foreignKey' => 'p1_id',
								'conditions' => 'RelationType1.deleted = 0',
								'fields' => array('id', 'title_from', 'title_to', 'vertex_types_from', 'vertex_types_to', 'pictogram_id', 'relation_class_id'),
								'order' => ''
			),
			'RelationType2' => array('className' => 'RelationType',
								'foreignKey' => 'p2_id',
								'conditions' => 'RelationType2.deleted = 0',
								'fields' => array('id', 'title_from', 'title_to', 'vertex_types_from', 'vertex_types_to', 'pictogram_id', 'relation_class_id'),
								'order' => ''
			),
			'RelationType3' => array('className' => 'RelationType',
								'foreignKey' => 'p3_id',
								'conditions' => 'RelationType3.deleted = 0',
								'fields' => array('id', 'title_from', 'title_to', 'vertex_types_from', 'vertex_types_to', 'pictogram_id', 'relation_class_id'),
								'order' => ''
			),
			'InferenceType' => array('className' => 'InferenceType',
								'foreignKey' => 'inference_type_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
	);

}
?>