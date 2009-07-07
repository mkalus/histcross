<?php
/*********************************************************
 * histcross v2.0
 * File: vertex_types_controller.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class VertexTypesController extends AppController {

	var $name = 'VertexTypes';
	var $helpers = array('Html', 'Form');
	var $paginate = array(
		'VertexType' => array(
			'contain' => array('VertexClass'),
			'limit' => PERPAGE,
			'order' => array(
				'VertexClass.sortkey' => 'asc'
			),
			'conditions' => 'VertexType.deleted = 0',
		),
		'Vertex' => array(
			'contain' => array('VertexType'),
			'limit' => PERPAGE,
			'order' => array(
				'Vertex.title' => 'asc'
			),
			'conditions' => array('Vertex.deleted = 0'),
		),
	);

	function index() {
		$this->set('vertexTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid VertexType.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->VertexType->contain('VertexClass', 'Creator', 'Changer');
		$this->paginate['Vertex']['conditions'][] = 'Vertex.vertex_type_id = '.$id;
		$this->set('vertices', $this->paginate('Vertex'));
		//pr($this->params);
		if ($this->RequestHandler->isAjax()) {
			$this->viewPath = 'elements';
			$this->set('elementtitle', 'Related Vertices');
			$this->set('useajax', true);
			$this->render('list_vertices');
		} else
			$this->set('vertexType', $this->VertexType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->VertexType->create();
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->VertexType->save($this->data)) {
				$this->Session->setFlash(__('The VertexType has been saved', true));
				if (isset($this->VertexType->id))
					$this->redirect(array('action'=>'view', $this->VertexType->id));
				else $this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The VertexType could not be saved. Please, try again.', true));
			}
		}
		$vertexClasses = $this->VertexType->VertexClass->find('list', array('conditions' => array('VertexClass.deleted' => '0')));
		$pictograms = $this->VertexType->Pictogram->find('list');
		$this->set(compact('vertexClasses', 'pictograms'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid VertexType', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->VertexType->save($this->data)) {
				$this->Session->setFlash(__('The VertexType has been saved', true));
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash(__('The VertexType could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->VertexType->contain();
			$this->data = $this->VertexType->read(null, $id);
		}
		$vertexClasses = $this->VertexType->VertexClass->find('list', array('conditions' => array('VertexClass.deleted' => '0')));
		$pictograms = $this->VertexType->Pictogram->find('list');
		$this->set(compact('vertexClasses','pictograms'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for VertexType', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->VertexType->saveField('deleted', 1);
		$this->Session->setFlash(__('VertexType deleted', true));
		$this->redirect(array('action'=>'index'));
	}

}
?>