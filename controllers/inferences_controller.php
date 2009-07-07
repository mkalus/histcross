<?php
/*********************************************************
 * histcross v2.0
 * File: inferences_controller.php
 * Created: 12.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class InferencesController extends AppController {

	var $name = 'Inferences';
	var $helpers = array('Html', 'Form', 'MultiCheckbox');

/*	function index() {
		$this->Inference->recursive = 0;
		$this->set('inferences', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Inference.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('inference', $this->Inference->read(null, $id));
	}
*/

	function add() {
		if (!empty($this->data)) {
			$this->Inference->create();
			if ($this->Inference->save($this->data)) {
				$this->Session->setFlash(__('The Inference has been saved', true));
				$this->redirect('/relation_types/view/'.$this->data['Inference']['p1_id']);
			} else {
				$this->Session->setFlash(__('The Inference could not be saved. Please, try again.', true));
			}
		}
		//check for parameters
		if(isset($this->params['named']) && isset($this->params['named']['relation_type']))
			$this->data['Inference']['p1_id'] = $this->params['named']['relation_type'];

		//create relation type list
		$relationTypes = $this->_getRelationTypeList();
		//create inference type list
		$inferenceTypes = $this->_getInferenceTypeList();
		$this->set(compact('relationTypes', 'inferenceTypes'));
		//Link Id
		if (isset($this->data['Inference']['p1_id']))
			$this->set('linkid', $this->data['Inference']['p1_id']);
		else $this->set('linkid', null);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Inference', true));
			$this->redirect('/');
		}
		if (!empty($this->data)) {
			if ($this->Inference->save($this->data)) {
				$this->Session->setFlash(__('The Inference has been saved', true));
				$this->redirect('/relation_types/view/'.$this->data['Inference']['p1_id']);
			} else {
				$this->Session->setFlash(__('The Inference could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Inference->read(null, $id);
		}
		//create relation type list
		$relationTypes = $this->_getRelationTypeList();
		//create inference type list
		$inferenceTypes = $this->_getInferenceTypeList();
		$this->set(compact('relationTypes', 'inferenceTypes'));
		//Link Id
		if (isset($this->data['Inference']['p1_id']))
			$this->set('linkid', $this->data['Inference']['p1_id']);
		else $this->set('linkid', null);
	}
	
	/**
	 * returns a RelationType-List for dropdowns...
	 */
	function _getRelationTypeList() {
		$relationTypes = array();
	
		$this->Inference->RelationType1->contain();
		$relationTypeList = $this->Inference->RelationType1->find('all', array('fields' => array('id', 'title_from', 'title_to'), 'order' => array('title_from' => 'ASC', 'title_to' => 'ASC'), 'conditions' => array('deleted' => 0)));
		foreach($relationTypeList as $val)
			$relationTypes[$val['RelationType1']['id']] = $val['RelationType1']['title_from'].'/'.$val['RelationType1']['title_to'];

		return $relationTypes;		
	}
	
	/**
	 * returns a RelationType-List for dropdowns...
	 */
	function _getInferenceTypeList() {
		$inferenceTypes = array();
		
		$this->Inference->InferenceType->contain();
		$inferenceTypeList = $this->Inference->InferenceType->find('all');
		foreach($inferenceTypeList as $val) {
			$inferenceTypes[$val['InferenceType']['id']] = '<img src="/img/inferences/inference_'.$val['InferenceType']['img'].'.png">';
		}
		
		return $inferenceTypes;		
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Inference', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Inference->saveField('deleted', 1);
		$this->Session->setFlash(__('Inference deleted', true));
		
		//read id of relation_type before redirecting
		//$this->Inference->read(null, $id);
		$this->redirect(array('action'=>'index'));
	}

}
?>