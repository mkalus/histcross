<?php
/*********************************************************
 * histcross v2.0
 * File: relation_types_controller.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class RelationTypesController extends AppController {

	var $name = 'RelationTypes';
	var $helpers = array('Html', 'Form', 'MultiCheckbox');
	var $paginate = array(
		'RelationType' => array(
			'contain' => array('RelationClass'),
			'limit' => PERPAGE,
			'order' => array(
				'RelationType.title_from' => 'asc'
			),
			'conditions' => 'RelationType.deleted = 0'
		),
		'Relation' => array(
			'contain' => array('VertexFrom', 'VertexTo', 'RelationType'),
			'limit' => PERPAGE,
			'order' => array(
				'Relation.relation_type_id' => 'asc'
			),
			'conditions' => array('Relation.deleted = 0')
		)
	);

	function index() {
		$this->set('relationTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid RelationType.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->RelationType->contain('RelationClass', 'Creator', 'Changer');
		$this->paginate['Relation']['conditions'][] = 'Relation.relation_type_id = '.$id;
		$this->set('relations', $this->paginate('Relation'));
		
		//load inferences to this id
		$this->set('inferences', $this->_loadInferences($id));
		
		if ($this->RequestHandler->isAjax()) {
			$this->viewPath = 'elements';
			$this->set('elementtitle', 'Related Relations');
			$this->set('useajax', true);
			$this->render('list_relations');
		} else
			$this->set('relationType', $this->RelationType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->RelationType->create();
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->RelationType->save($this->data)) {
				$this->Session->setFlash(__('The RelationType has been saved', true));
				if (isset($this->RelationType->id))
					$this->redirect(array('action'=>'view', $this->RelationType->id));
				else $this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The RelationType could not be saved. Please, try again.', true));
			}
		}
		$relationClasses = $this->RelationType->RelationClass->find('list', array('conditions' => array('RelationClass.deleted' => '0')));
		$pictograms = $this->RelationType->Pictogram->find('list');
		$this->set(compact('relationClasses', 'pictograms'));
		$this->_prepareVertexTypes();
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid RelationType', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->RelationType->save($this->data)) {
				$this->Session->setFlash(__('The RelationType has been saved', true));
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash(__('The RelationType could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->RelationType->contain();
			$this->data = $this->RelationType->read(null, $id);
		}
		$relationClasses = $this->RelationType->RelationClass->find('list', array('conditions' => array('RelationClass.deleted' => '0')));
		$pictograms = $this->RelationType->Pictogram->find('list');
		$this->set(compact('relationClasses','pictograms'));
		$this->_prepareVertexTypes();
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for RelationType', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->RelationType->saveField('deleted', 1);
		$this->Session->setFlash(__('RelationType deleted', true));
		$this->redirect(array('action'=>'index'));
	}
	
	/**
	 * loads a list of Vertex Types
	 */
	function _prepareVertexTypes() {
		//Load Model of Relations
		$this->loadModel('VertexType');
		$this->VertexType = new VertexType();
		
		$this->VertexType->contain();
		$vertexTypes = $this->VertexType->find('list', array('conditions' => array('VertexType.deleted' => '0'), 'order' => 'VertexType.title'));
		$this->set(compact('vertexTypes',$vertexTypes));
	}
	
	/**
	 * load inferences
	 */
	function _loadInferences($id) {
		if (!$id) return null;
		
		//Load Model of Relations
		$this->loadModel('Inference');
		$this->Inference = new Inference();
		
		$this->Inference->contain('RelationType1', 'RelationType2', 'RelationType3', 'InferenceType');
		return $this->Inference->find('all', array('conditions' => array('Inference.p1_id' => $id)));
	}
}
?>