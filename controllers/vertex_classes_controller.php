<?php
/*********************************************************
 * histcross v2.0
 * File: vertex_classes_controller.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class VertexClassesController extends AppController {

	var $name = 'VertexClasses';
	var $helpers = array('Html', 'Form');
	var $paginate = array(
		'VertexClass' => array(
			'contain' => false,
			'limit' => PERPAGE,
			'order' => array(
				'VertexClass.title' => 'asc'
			),
			'conditions' => 'VertexClass.deleted = 0',
		),
		'VertexType' => array(
			'contain' => array('VertexClass'),
			'limit' => PERPAGE,
			'order' => array(
				'VertexType.title' => 'asc'
			),
			'conditions' => array('VertexType.deleted = 0'),
		),
	);

	function index() {
		$this->set('vertexClasses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid VertexClass.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->VertexClass->contain('Creator', 'Changer');
		$this->paginate['VertexType']['conditions'][] = 'VertexType.vertex_class_id = '.$id;
		$this->set('vertexTypes', $this->paginate('VertexType'));
		
		if ($this->RequestHandler->isAjax()) {
			$this->viewPath = 'elements';
			$this->set('elementtitle', 'Related Vertex Types');
			$this->set('useajax', true);
			$this->render('list_vertex_types');
		} else
			$this->set('vertexClass', $this->VertexClass->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->VertexClass->create();
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->VertexClass->save($this->data)) {
				$this->Session->setFlash(__('The VertexClass has been saved', true));
				if (isset($this->VertexClass->id))
					$this->redirect(array('action'=>'view', $this->VertexClass->id));
				else $this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The VertexClass could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid VertexClass', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->VertexClass->save($this->data)) {
				$this->Session->setFlash(__('The VertexClass has been saved', true));
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash(__('The VertexClass could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->VertexClass->contain();
			$this->data = $this->VertexClass->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for VertexClass', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->VertexClass->saveField('deleted', 1);
		$this->Session->setFlash(__('VertexClass deleted', true));
		$this->redirect(array('action'=>'index'));
	}

}
?>