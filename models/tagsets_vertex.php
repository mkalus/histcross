<?php
/*********************************************************
 * histcross v2.0
 * File: tagsets_vertex.php
 * Created: 11.12.2008
  * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class TagsetsVertex extends AppModel {
	var $actsAs = array('Containable');

	var $name = 'TagsetsVertex';
	var $validate = array(
		'tagset_id' => array('numeric'),
		'vertex_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Tagset' => array('className' => 'Tagset',
								'foreignKey' => 'tagset_id',
								'conditions' => 'Tagset.deleted = 0',
								'fields' => '',
								'order' => ''
			),
			'Vertex' => array('className' => 'Vertex',
								'foreignKey' => 'vertex_id',
								'conditions' => 'Vertex.deleted = 0',
								'fields' => '',
								'order' => ''
			)
	);
	
	function beforeDelete() {
		//find entry
		$this->contain();
		$entry = $this->find('all', array('conditions' => array('id' => $this->id)));
		
		if (count($entry) == 0) return true; //nothing to do...
		$entry = $entry[0]['TagsetsVertex'];

		//find, how many entries remain
		$count = $this->find('count', array('conditions' => array('tagset_id' => $entry['tagset_id'])));
		
		//this entry is the last one -> delete also!
		if ($count <= 1) {
			$data = array('id' => $entry['tagset_id'], 'deleted' => 1);
			$this->Tagset->save($data);
		}
		
		return true;
	}
}
?>