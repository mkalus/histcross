<?php
/*********************************************************
 * histcross v2.0
 * File: pictograms_controller.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class PictogramsController extends AppController {

	var $name = 'Pictograms';
	var $helpers = array('Html', 'Form');
	var $paginate = array(
		'contain' => false,
		'limit' => PERPAGE,
		'order' => array(
			'Pictogram.title' => 'asc'
		),
	);

	function index() {
		$this->Pictogram->contain();
		$this->set('pictograms', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Pictogram.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('pictogram', $this->Pictogram->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Pictogram->create();
			if ($this->Pictogram->save($this->data)) {
				$this->Session->setFlash(__('The Pictogram has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Pictogram could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Pictogram', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Pictogram->save($this->data)) {
				$this->Session->setFlash(__('The Pictogram has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Pictogram could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->Pictogram->contain();
			$this->data = $this->Pictogram->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Pictogram', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pictogram->del($id)) {
			$this->Session->setFlash(__('Pictogram deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>