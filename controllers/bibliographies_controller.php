<?php
/*********************************************************
 * histcross v2.0
 * File: bibliographies_controller.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class BibliographiesController extends AppController {

	var $name = 'Bibliographies';
	var $helpers = array('Html', 'Form');
	var $paginate = array(
		'Bibliography' => array(
			'contain' => false,
			'limit' => PERPAGE,
			'order' => array(
				'Bibliography.shortref' => 'asc'
			),
			'conditions' => 'Bibliography.deleted = 0',
		),
	);

	function index() {
		$this->set('bibliographies', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Bibliography.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Bibliography->contain(array(
			'Creator', 'Changer',
/*			'Vertex' => array('VertexType'),
			'Relation' => array(
				'RelationType',
				'VertexFrom' => array('VertexType'),
				'VertexTo' => array('VertexType'),
			),*/
		));
		$this->set('bibliography', $this->Bibliography->read(null, $id));
		
		//find vertices
		$this->set('vertices', $this->Bibliography->query("SELECT `Vertex`.`id`, `Vertex`.`start_time_entry`, `Vertex`.`stop_time_entry`, `Vertex`.`start_time`, `Vertex`.`stop_time`, `Vertex`.`start_time_ca`, `Vertex`.`stop_time_ca`, `Vertex`.`start_time_questionable`, `Vertex`.`stop_time_questionable`, `Vertex`.`start_time_julian`, `Vertex`.`stop_time_julian`, `Vertex`.`title`, `Vertex`.`vertex_type_id`, `Vertex`.`pictogram_id`, `BibliographiesVertex`.`id`, `BibliographiesVertex`.`vertex_id`, `BibliographiesVertex`.`pages`, `VertexType`.`title`, `VertexType`.`pictogram_id` FROM `hc_vertices` AS `Vertex` JOIN `hc_bibliographies_vertices` AS `BibliographiesVertex` ON (`BibliographiesVertex`.`bibliography_id` = '".mysql_escape_string($id)."' AND `BibliographiesVertex`.`vertex_id` = `Vertex`.`id`) JOIN `hc_vertex_types` AS `VertexType` ON (`Vertex`.`vertex_type_id` = `VertexType`.`id`) WHERE `VertexType`.`deleted` = 0 AND `Vertex`.`deleted` = 0 AND `BibliographiesVertex`.`deleted` = 0 ORDER BY `BibliographiesVertex`.`pages` ASC"));
		//find relations
		$this->set('relations', $this->Bibliography->query("SELECT `Relation`.`id`, `Relation`.`start_time_entry`, `Relation`.`stop_time_entry`, `Relation`.`start_time`, `Relation`.`stop_time`, `Relation`.`start_time_ca`, `Relation`.`stop_time_ca`, `Relation`.`start_time_questionable`, `Relation`.`stop_time_questionable`, `Relation`.`start_time_julian`, `Relation`.`stop_time_julian`, `Relation`.`relation_type_id`, `Relation`.`from_vertex_id`, `Relation`.`to_vertex_id`, `BibliographiesRelation`.`pages`, `VertexFrom`.`title`, `VertexFrom`.`pictogram_id`, `VertexTo`.`title`, `VertexTo`.`pictogram_id`, `VertexTypeFrom`.`pictogram_id`, `VertexTypeTo`.`pictogram_id`, `RelationType`.`title_from`, `RelationType`.`pictogram_id` FROM `hc_relations` AS `Relation` JOIN `hc_bibliographies_relations` AS `BibliographiesRelation` ON (`BibliographiesRelation`.`bibliography_id` = '".mysql_escape_string($id)."' AND `BibliographiesRelation`.`relation_id` = `Relation`.`id`) JOIN `hc_relation_types` AS `RelationType` ON (`Relation`.`relation_type_id` = `RelationType`.`id` AND `RelationType`.`deleted` = 0) JOIN `hc_vertices` AS `VertexFrom` ON (`Relation`.`from_vertex_id` = `VertexFrom`.`id` AND `VertexFrom`.`deleted` = 0) JOIN `hc_vertices` AS `VertexTo` ON (`Relation`.`to_vertex_id` = `VertexTo`.`id` AND `VertexTo`.`deleted` = 0) JOIN `hc_vertex_types` AS `VertexTypeFrom` ON (`VertexFrom`.`vertex_type_id` = `VertexTypeFrom`.`id` AND `VertexTypeFrom`.`deleted` = 0) JOIN `hc_vertex_types` AS `VertexTypeTo` ON (`VertexTo`.`vertex_type_id` = `VertexTypeTo`.`id` AND `VertexTypeTo`.`deleted` = 0) WHERE `Relation`.`deleted` = 0 AND `BibliographiesRelation`.`deleted` = 0 ORDER BY `BibliographiesRelation`.`pages` ASC")); 
	}

	function add() {
		if (!empty($this->data)) {
			$this->Bibliography->create();
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->Bibliography->save($this->data)) {
				$this->Session->setFlash(__('The Bibliography has been saved', true));
				if (isset($this->Bibliography->id))
					$this->redirect(array('action'=>'view', $this->Bibliography->id));
				else $this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Bibliography could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Bibliography', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->Bibliography->save($this->data)) {
				$this->Session->setFlash(__('The Bibliography has been saved', true));
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash(__('The Bibliography could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->Bibliography->contain();
			$this->data = $this->Bibliography->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Bibliography', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Bibliography->saveField('deleted', 1);
		$this->Session->setFlash(__('Bibliography deleted', true));
		$this->redirect(array('action'=>'index'));
	}

}
?>