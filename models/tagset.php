<?php
/*********************************************************
 * histcross v2.0
 * File: tagset.php
 * Created: 11.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class Tagset extends AppModel {
	var $actsAs = array('Containable', 'CreatorChanger');


	var $name = 'Tagset';
	var $validate = array(
		'creator_id' => array('numeric'),
		'changer_id' => array('numeric'),
		'deleted' => array('numeric'),
		'title' => array(
			'notempty' => array(
				'rule' => 'notempty',
				'message' => 'Title cannot be empty.',
				'last' => true
			),
			'checkTitle' => array(
				'rule' => 'checkTitle',
				'message' => 'Class/Title separation has do be done correctly using a "class:title" pattern.'
			),
		),
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
		)
	);

	var $hasAndBelongsToMany = array(
			'Vertex' => array('className' => 'Vertex',
						'joinTable' => 'tagsets_vertices',
						'foreignKey' => 'tagset_id',
						'associationForeignKey' => 'vertex_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			)
	);
	
	function checkTitle($field, $alsoCheckEmpty = false) {
		$title = $field['title'];
		if ($title == '') {
			if ($alsoCheckEmpty) return false;
			return true; //handled by other check condition...
		}
		
		$pos = strpos($title, ':');
		if ($pos !== false) { //different check cases...
			if ($pos == 0 && strlen($title) == 1) return false; //only submitted ":"
			if ($pos == strlen($title)-1) return false; //submitted something like "abc:"
		}
		return true;
	}
	
	function afterSave($created) {
		if (!isset($this->data['Tagset']['vertex_id']) || !is_numeric($this->data['Tagset']['vertex_id'])) return true;
		
		//create automatic vertex relationships...

		//Figure out id
		if ($created) $myid = $this->getLastInsertID();
		else $myid = $this->data['Tagset']['id'];
		
		//ok, check for existance of entry...
		$this->TagsetVertex = ClassRegistry::init('TagsetsVertex');
		$conditions = array('vertex_id' => $this->data['Tagset']['vertex_id'], 'tagset_id' => $myid);
		$check = $this->TagsetVertex->find('list', array('conditions' => $conditions));
		
		//no entry detected: add new one!
		if (count($check) == 0) {
			$data = array('TagsetsVertex' => $conditions);
			$this->TagsetVertex->save($data);
		}
	}
}
?>