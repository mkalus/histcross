<?php
/*********************************************************
 * histcross v2.0
 * File: relation_type.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class RelationType extends AppModel {
	var $actsAs = array('Containable', 'CreatorChanger');

	var $name = 'RelationType';
	var $validate = array(
		'creator_id' => array('numeric'),
		'changer_id' => array('numeric'),
		'deleted' => array('numeric'),
		'relation_class_id' => array('numeric'),
		'title_from' => array('notempty' => array(
				'rule' => 'notempty',
				'message' => 'Title cannot be left blank',
				'last' => true
			), 'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Title must be unique',
			),
		),
		'title_to' => array('notempty' => array(
				'rule' => 'notempty',
				'message' => 'Title cannot be left blank',
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
			'RelationClass' => array('className' => 'RelationClass',
								'foreignKey' => 'relation_class_id',
								'conditions' => 'RelationClass.deleted = 0',
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
			'Relation' => array('className' => 'Relation',
								'foreignKey' => 'relation_type_id',
								'dependent' => false,
								'conditions' => 'Relation.deleted = 0',
								'fields' => '',
								'order' => '',
								'limit' => '1',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Inference1' => array('className' => 'Inference',
								'foreignKey' => 'p1_id',
								'dependent' => false,
								'conditions' => 'Inference1.deleted = 0',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Inference2' => array('className' => 'Inference',
								'foreignKey' => 'p2_id',
								'dependent' => false,
								'conditions' => 'Inference2.deleted = 0',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Inference3' => array('className' => 'Inference',
								'foreignKey' => 'p3_id',
								'dependent' => false,
								'conditions' => 'Inference3.deleted = 0',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
	);

	function beforeSave() {
		$this->data['RelationType']['vertex_types_from'] = $this->_extractOnes($this->data['RelationType']['vertex_types_from']);
		$this->data['RelationType']['vertex_types_to'] = $this->_extractOnes($this->data['RelationType']['vertex_types_to']);
		return true;
	}
	
	function _extractOnes($array) {
		if (!is_array($array)) return $array;
		$imploder = array();
		foreach($array as $key => $val) {
			if ($val == 1) $imploder[] = $key;
		}
		return implode(',', $imploder);
	}
}
?>