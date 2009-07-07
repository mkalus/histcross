<?php
/*********************************************************
 * histcross v2.0
 * File: vertex_type.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class VertexType extends AppModel {
	var $actsAs = array('Containable', 'CreatorChanger');

	var $name = 'VertexType';
	var $validate = array(
		'creator_id' => array('numeric'),
		'changer_id' => array('numeric'),
		'deleted' => array('numeric'),
		'vertex_classes_id' => array('numeric'),
		'title' => array('notempty' => array(
				'rule' => 'notempty',
				'message' => 'Title cannot be left blank',
				'last' => true
			), 'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Title must be unique',
			),
		),
		'pictogram_id' => array('numeric'),
		'show_date' => array('numeric'),
		'show_geo' => array('numeric')
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
			'VertexClass' => array('className' => 'VertexClass',
								'foreignKey' => 'vertex_class_id',
								'conditions' => 'VertexClass.deleted = 0',
								'fields' => array('id', 'title'),
								'order' => ''
			),
			'Pictogram' => array('className' => 'Pictogram',
								'foreignKey' => 'pictogram_id',
								'conditions' => '',
								'fields' => array('id', 'title'),
								'order' => ''
			)
	);

	var $hasMany = array(
			'Vertex' => array('className' => 'Vertex',
								'foreignKey' => 'vertex_type_id',
								'dependent' => false,
								'conditions' => 'Vertex.deleted = 0',
								'fields' => '',
								'order' => '',
								'limit' => '1',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);

}
?>