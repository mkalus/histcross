<?php
/*********************************************************
 * histcross v2.0
 * File: vertex_class.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class VertexClass extends AppModel {
	var $actsAs = array('Containable', 'CreatorChanger');

	var $name = 'VertexClass';
	var $validate = array(
		'creator_id' => array('numeric'),
		'changer_id' => array('numeric'),
		'deleted' => array('numeric'),
		'title' => array('notempty' => array(
				'rule' => 'notempty',
				'message' => 'Title cannot be left blank',
				'last' => true
			), 'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Title must be unique',
			),
		),
		'sortkey' => array('rule' => array('range', 0, 256), 'message' => 'Key must be a nuber between 1 and 255')
	);

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
		)
	);
	var $hasMany = array(
			'VertexType' => array('className' => 'VertexType',
								'foreignKey' => 'vertex_class_id',
								'dependent' => false,
								'conditions' => 'VertexType.deleted = 0',
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