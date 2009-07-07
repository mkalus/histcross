<?php
/*********************************************************
 * histcross v2.0
 * File: relation_classes_controller.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class RelationClassesController extends AppController {

	var $name = 'RelationClasses';
	var $helpers = array('Html', 'Form');
	var $paginate = array(
		'RelationClass' => array(
			'contain' => false,
			'limit' => PERPAGE,
			'order' => array(
				'RelationClass.title' => 'asc'
			),
			'conditions' => 'RelationClass.deleted = 0',
		),
		'RelationType' => array(
			'contain' => array('RelationClass'),
			'limit' => PERPAGE,
			'order' => array(
				'RelationType.title_from' => 'asc'
			),
			'conditions' => array('RelationType.deleted = 0')
		),
	);

	function index() {
		$this->set('relationClasses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid RelationClass.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->RelationClass->contain('Creator', 'Changer');
		$this->paginate['RelationType']['conditions'][] = 'RelationType.relation_class_id = '.$id;
		$this->set('relationTypes', $this->paginate('RelationType'));
		
		if ($this->RequestHandler->isAjax()) {
			$this->viewPath = 'elements';
			$this->set('elementtitle', 'Related Relation Types');
			$this->set('useajax', true);
			$this->render('list_relation_types');
		} else
			$this->set('relationClass', $this->RelationClass->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->RelationClass->create();
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->RelationClass->save($this->data)) {
				$this->Session->setFlash(__('The RelationClass has been saved', true));
				if (isset($this->RelationClass->id))
					$this->redirect(array('action'=>'view', $this->RelationClass->id));
				else $this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The RelationClass could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid RelationClass', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->RelationClass->save($this->data)) {
				$this->Session->setFlash(__('The RelationClass has been saved', true));
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash(__('The RelationClass could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->RelationClass->contain();
			$this->data = $this->RelationClass->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for RelationClass', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->RelationClass->saveField('deleted', 1);
		$this->Session->setFlash(__('RelationClass deleted', true));
		$this->redirect(array('action'=>'index'));
	}

}
?>