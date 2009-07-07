<?php
/*********************************************************
 * histcross v2.0
 * File: vertex.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class Vertex extends AppModel {
	var $actsAs = array('Containable', 'Geography', 'JulianDate', 'CreatorChanger');

	var $name = 'Vertex';
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
		'title' => array('notempty' => array(
				'rule' => 'notempty',
				'message' => 'Title cannot be left blank',
				'last' => true
			), 'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Title must be unique',
			),
		),
		'vertex_type_id' => array('numeric'),
		//'pictogram_id' => array('numeric'),
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
			'VertexType' => array('className' => 'VertexType',
								'foreignKey' => 'vertex_type_id',
								'conditions' => 'VertexType.deleted = 0',
								'fields' => array('id', 'title', 'pictogram_id', 'show_date', 'show_geo', 'vertex_class_id')
			),
			'Pictogram' => array('className' => 'Pictogram',
								'foreignKey' => 'pictogram_id'
			)
	);

	var $hasMany = array(
			'RelationFrom' => array('className' => 'Relation',
								'foreignKey' => 'from_vertex_id',
								'dependent' => false,
								'conditions' => 'RelationFrom.deleted = 0',
								'fields' => '',
								'order' => '',
								'limit' => '1',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'RelationTo' => array('className' => 'Relation',
								'foreignKey' => 'to_vertex_id',
								'dependent' => false,
								'conditions' => 'RelationTo.deleted = 0',
								'fields' => '',
								'order' => '',
								'limit' => '1',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
	);
	var $hasAndBelongsToMany = array(
			'Bibliography' => array('className' => 'Bibliography',
						'joinTable' => 'bibliographies_vertices',
						'foreignKey' => 'vertex_id',
						'associationForeignKey' => 'bibliography_id',
						'unique' => true,
						'conditions' => 'Bibliography.deleted = 0',
						'fields' => '',
						'order' => 'Bibliography.shorttitle',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			),
			'Tagset' => array('className' => 'Tagset',
						'joinTable' => 'tagsets_vertices',
						'foreignKey' => 'vertex_id',
						'associationForeignKey' => 'tagset_id',
						'unique' => true,
						'conditions' => 'Tagset.deleted = 0',
						'fields' => '',
						'order' => 'Tagset.group, Tagset.title',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			),
	);

	function afterFind($results, $primary = false) {
		//no primary statement
		if (!$primary) {
			//search for possible Vertex occurances
			for ($i = 0; $i < count($results); $i++)
				if (key_exists($i, $results))
					foreach ($results[$i] as $key => $val)
						if (strlen($key) > 5 && substr($key, 0, 6) == 'Vertex')
							//Check, if the icon is set to 0 - if yes, fetch it!
							if (isset($val['pictogram_id'], $val['vertex_type_id']) && $val['pictogram_id'] == 0) {
								//cache this query
								$this->VertexType->cacheQueries = 1;
								//fetch the Picture-Id
								$newicon = $this->VertexType->find('first', array(
									'conditions' => array('VertexType.id' => $val['vertex_type_id']), //array of conditions
									'recursive' => 0, //int
									'fields' => array('VertexType.pictogram_id'), //array of field names
								));
								//put it in place of the old (empty property)
								$results[$i][$key]['pictogram_id'] = $newicon['VertexType']['pictogram_id'];
							}
		} else {
			//no search necessary here, since the model provides for a reference to the vertex type
			for ($i = 0; $i < count($results); $i++) {
				//easier here: just check, if the Models exists here and if the
				//image has not been set yet...
				if (key_exists('Vertex', $results[$i]) && key_exists('VertexType', $results[$i])
					&& isset($results[$i]['Vertex']['pictogram_id'])
					&& $results[$i]['Vertex']['pictogram_id'] == 0)
					$results[$i]['Vertex']['pictogram_id'] = $results[$i]['VertexType']['pictogram_id'];
			}
		}
		
		return $results;
	}
	
	function beforeSave() {
		//overwrite Picture-Id with 0, if not set to avoid SQL error
		if (key_exists('pictogram_id', $this->data['Vertex']) && !$this->data['Vertex']['pictogram_id']) $this->data['Vertex']['pictogram_id'] = 0;
		return true;
	}
}
?>