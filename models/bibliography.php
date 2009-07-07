<?php
/*********************************************************
 * histcross v2.0
 * File: bibliography.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class Bibliography extends AppModel {
	var $actsAs = array('Containable', 'CreatorChanger');

	var $name = 'Bibliography';
	var $validate = array(
		'creator_id' => array('numeric'),
		'changer_id' => array('numeric'),
		'deleted' => array('numeric'),
		'shorttitle' => array('notempty' => array(
				'rule' => 'notempty',
				'message' => 'This field cannot be left blank',
				'last' => true
			), 'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Title must be unique',
			),
		),
		'longtitle' => array('notempty'),
		'shortref' => array('notempty' => array(
				'rule' => 'notempty',
				'message' => 'This field cannot be left blank',
				'last' => true
			), 'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Reference must be unique',
			),
		),
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
	var $hasAndBelongsToMany = array(
			'Vertex' => array('className' => 'Vertex',
						'joinTable' => 'bibliographies_vertices',
						'foreignKey' => 'bibliography_id',
						'associationForeignKey' => 'vertex_id',
						'unique' => true,
						'conditions' => array('Vertex.deleted' => '0', 'BibliographiesVertex.deleted' => '0'),
						'fields' => '',
						'order' => 'BibliographiesVertex.pages',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			),
			'Relation' => array('className' => 'Relation',
						'joinTable' => 'bibliographies_relations',
						'foreignKey' => 'bibliography_id',
						'associationForeignKey' => 'relation_id',
						'unique' => true,
						'conditions' => array('Relation.deleted' => '0', 'BibliographiesRelation.deleted' => '0'),
						'fields' => '',
						'order' => 'BibliographiesRelation.pages',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			)
	);
}
?>