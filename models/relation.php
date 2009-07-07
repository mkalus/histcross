<?php
/*********************************************************
 * histcross v2.0
 * File: relation.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class Relation extends AppModel {
	var $actsAs = array('Containable', 'Geography', 'JulianDate', 'CreatorChanger');

	var $name = 'Relation';
	var $validate = array(
		'creator_id' => array('numeric'),
		'changer_id' => array('numeric'),
		'deleted' => array('numeric'),
		'start_time_entry' => array('rule' => 'validateStartTime', 'message' => 'Date has to be entered in the format DD.MM.YYYY (or MM.YYYY or YYYY)'),
		'stop_time_entry' => array('rule' => 'validateStopTime', 'message' => 'Date has to be entered in the format DD.MM.YYYY (or MM.YYYY or YYYY)'),
		'start_time_ca' => array('numeric'),
		'stop_time_ca' => array('numeric'),
		'start_time_questionable' => array('numeric'),
		'stop_time_questionable' => array('numeric'),
		'start_time_julian' => array('numeric'),
		'stop_time_julian' => array('numeric'),
		'relation_type_id' => array('numeric'),
		'from_vertex_id' => array('numeric'),
		'to_vertex_id' => array('numeric'),
		'geo' => array('rule' => 'validateCoordinatePair', 'message' => 'Coordinates entered are not the right format - lat/lon as decimal format (12.33333 55.33333) or in degree format (dd:mm:ssN dd:mm:ssE)')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Creator' => array('className'  => 'User',
								'foreignKey' => 'creator_id',
								'conditions' => 'Creator.deleted = 0',
								'fields'     => array('id', 'name') 
			),
			'Changer' => array('className'  => 'User',
								'foreignKey' => 'changer_id',
								'conditions' => 'Changer.deleted = 0',
								'fields'     => array('id', 'name') 
			),
			'RelationType' => array('className' => 'RelationType',
								'foreignKey' => 'relation_type_id',
								'conditions' => 'RelationType.deleted = 0',
								'fields' => array('id', 'title_from', 'title_to', 'pictogram_id', 'show_date', 'show_geo', 'relation_class_id'),
								'order' => ''
			),
			'VertexFrom' => array('className' => 'Vertex',
								'foreignKey' => 'from_vertex_id',
								'conditions' => 'VertexFrom.deleted = 0',
								'fields' => array('id', 'title', 'pictogram_id', 'vertex_type_id'),
								'order' => ''
			),
			'VertexTo' => array('className' => 'Vertex',
								'foreignKey' => 'to_vertex_id',
								'conditions' => 'VertexTo.deleted = 0',
								'fields' => array('id', 'title', 'pictogram_id', 'vertex_type_id'),
								'order' => ''
			),
	);

	var $hasAndBelongsToMany = array(
			'Bibliography' => array('className' => 'Bibliography',
						'joinTable' => 'bibliographies_relations',
						'foreignKey' => 'relation_id',
						'associationForeignKey' => 'bibliography_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => 'Bibliography.shorttitle',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			)
	);

	function aggregateTagcloudFrom() {
		$back = array();
		$linkhelper = array();
		$result = $this->query("SELECT COUNT(*) as `count`, `VertexFrom`.`id`, `VertexFrom`.`title` FROM `hc_relations` AS `Relation` INNER JOIN `hc_vertices` AS `VertexFrom` ON (`VertexFrom`.`deleted` = 0 AND `Relation`.`from_vertex_id` = `VertexFrom`.`id`) WHERE `Relation`.`deleted` = 0 GROUP BY `VertexFrom`.`id`, `VertexFrom`.`title` ORDER BY COUNT(*) DESC LIMIT 0,40;");
		
		foreach($result as $entry) {
			$back[$entry['VertexFrom']['title']] = $entry[0]['count'];
			$linkhelper[$entry['VertexFrom']['title']] = $entry['VertexFrom']['id'];
		}
		
		return array('tags' => $back, 'idlist' => $linkhelper);
	}

	function aggregateTagcloudTo() {
		$back = array();
		$linkhelper = array();
		$result = $this->query("SELECT COUNT(*) as `count`, `VertexTo`.`id`, `VertexTo`.`title` FROM `hc_relations` AS `Relation` INNER JOIN `hc_vertices` AS `VertexTo` ON (`VertexTo`.`deleted` = 0 AND `Relation`.`to_vertex_id` = `VertexTo`.`id`) WHERE `Relation`.`deleted` = 0 GROUP BY `VertexTo`.`id`, `VertexTo`.`title` ORDER BY COUNT(*) DESC LIMIT 0,40;");
		
		foreach($result as $entry) {
			$back[$entry['VertexTo']['title']] = $entry[0]['count'];
			$linkhelper[$entry['VertexTo']['title']] = $entry['VertexTo']['id'];
		}
		
		return array('tags' => $back, 'idlist' => $linkhelper);
	}
}
?>