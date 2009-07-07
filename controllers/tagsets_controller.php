<?php
/*********************************************************
 * histcross v2.0
 * File: tagsets_controller.php
 * Created: 11.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class TagsetsController extends AppController {

	var $name = 'Tagsets';
	var $helpers = array('Html', 'Form', 'Tagcloud', 'Network');

	function index() {
		$list = $this->_prepareTagsetCloud();
		$this->set('tags', $list['tags']);
		$this->set('idlist', $list['idlist']);
		
		$this->Tagset->contain();
		$this->set('tagsets', $this->Tagset->find('all', array('conditions' => array('deleted = 0'), 'order' => 'group, title')));
	}

	function _prepareTagsetCloud() {
		$back = array();
		$linkhelper = array();
		$result = $this->Tagset->query("SELECT count(*) as `count`, `Tagset`.`id`, `Tagset`.`group` , `Tagset`.`title` FROM `hc_tagsets_vertices` AS `TagsetsVertex` LEFT JOIN `hc_tagsets` AS `Tagset` ON ( `Tagset`.`deleted` =0 AND `TagsetsVertex`.`tagset_id` = `Tagset`.`id` ) LEFT JOIN `hc_vertices` AS `Vertex` ON ( `Vertex`.`deleted` =0 AND `TagsetsVertex`.`vertex_id` = `Vertex`.`id`) GROUP BY `Tagset`.`group` , `Tagset`.`title`;");
		
		foreach($result as $entry) {
			if ($entry['Tagset']['group'] != '') $title = $entry['Tagset']['group'].':'.$entry['Tagset']['title']; 
			else $title = $entry['Tagset']['title'];
			$back[$title] = $entry[0]['count'];
			$linkhelper[$title] = $entry['Tagset']['id'];
		}
		
		return array('tags' => $back, 'idlist' => $linkhelper);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Tag Set.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$this->Tagset->contain('Creator', 'Changer');
		$this->set('tagset', $this->Tagset->read(null, $id));
		
		//now read connections between the vertices
		//if no Ajax or direct url has been called
		if (isset($this->params['named']['shownetwork'])) {
			$relation_sets = $this->_getNetwork($id, false);
			
			$this->set('vertices', $relation_sets['vertices']);
			$this->set('edges', $relation_sets['edges']);
		} else {
			$relation_sets = $this->_getNetwork($id);
		
			$this->set('vertices', $relation_sets);
			$this->set('edges', null);
		}
	}
	
	/**
	 * created the Network output...
	 */
	function viewnetwork($id) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Tag Set', true));
			$this->redirect(array('action'=>'index'));
		}
		//if not Ajax -> view page with network
		if (!$this->RequestHandler->isAjax()) {
			$this->redirect(array('action'=>'view', $id, 'shownetwork' => 'yes'));
		}
		//Read data
		$relation_sets = $this->_getNetwork($id, false);
		
		$this->set('vertices', $relation_sets['vertices']);
		$this->set('edges', $relation_sets['edges']);
		$this->set('id', $id);
		$this->set('model', $this->name);
	}
	
	/**
	 * returns the network
	 */
	function _getNetwork($id, $onlyVertices = true) {
		//get vertices
		/*
		$this->Tagset->TagsetsVertex->contain(array(
			'Vertex' => array('fields' => array('Vertex.id', 'Vertex.title'))
		));
		$vtx = $this->Tagset->TagsetsVertex->find('all', array('conditions' => array('TagsetsVertex.tagset_id' => $id), 'order' => 'Vertex.title'));
		*/
		$vtx = $this->Tagset->query("SELECT `TagsetsVertex`.`id`, `TagsetsVertex`.`tagset_id`, `TagsetsVertex`.`vertex_id`, `Vertex`.`id`, `Vertex`.`title` FROM `hc_tagsets_vertices` AS `TagsetsVertex` JOIN `hc_vertices` AS `Vertex` ON (`TagsetsVertex`.`vertex_id` = `Vertex`.`id` AND `Vertex`.`deleted` = 0) WHERE `TagsetsVertex`.`tagset_id` = '".mysql_escape_string($id)."' ORDER BY `Vertex`.`title` ASC");
		
		//aggregate id-List
		$vertices = array(); $idlist = array();
		foreach($vtx as $vertex) {
			$vertices[$vertex['Vertex']['id']] = $vertex['Vertex']['title'];
			$idlist[] = $vertex['Vertex']['id'];
		}
		
		//only return vertices
		if ($onlyVertices) return $vertices;
		
		//otherwise work on and also load model
		unset($vtx);
		
		//now get conncetions between the nodes
		$this->loadModel('Relation');
		$this->Relation = new Relation();
		$this->Relation->contain(array('RelationType' => array('id', 'title_from', 'title_to')));
		$edges = $this->Relation->find('all', array(
			'fields' => array('Relation.id', 'Relation.start_time', 'Relation.stop_time', 'Relation.start_time_entry', 'Relation.stop_time_entry', 'Relation.start_time_ca', 'Relation.stop_time_ca', 'Relation.start_time_questionable', 'Relation.stop_time_questionable', 'Relation.start_time_julian', 'Relation.stop_time_julian', 'RelationType.title_from', 'RelationType.title_to', 'Relation.from_vertex_id', 'Relation.to_vertex_id'),
			'conditions' => array(
				'Relation.deleted' => 0,
				'Relation.from_vertex_id' => $idlist,
				'Relation.to_vertex_id' => $idlist,
			),
		));
		
		return array('vertices' => $vertices, 'edges' => $edges);
	}

	function add_set($id = null) {
		if (key_exists('data' , $this->params) && key_exists('Tagset' , $this->params['data'])
			&& key_exists('vertex_id' , $this->params['data']['Tagset']))
				$id = $this->params['data']['Tagset']['vertex_id'];
		
		//check id first
		if (!$id || !is_numeric($id)) {
			if ($this->RequestHandler->isAjax()) {
				$this->Session->setFlash('Error: Invalid Vertex.', 'default', array(), 'tagset');
				$this->viewPath = 'elements';
				$this->set('tagsets', array());
				$this->set('id', -1);
				$this->render('view_tagset_list');
			} else {
				$this->Session->setFlash(__('Invalid Vertex.', true));
				$this->redirect(array('action'=>'index'));
			}
		}
		
		//ok, everything ok...
		$this->set('id', $id);

		if (!empty($this->data)) {
			$this->Tagset->create();
			$data = $this->_prepareData($this->data);
			if ($this->Tagset->save($data)) {
				if ($this->RequestHandler->isAjax()) {
					$this->Session->setFlash(__('The Tag Set has been saved.', true), 'default', array(), 'tagset');
					$this->viewPath = 'elements';
					$this->set('tagsets', $this->_getTagsets($id));
					$this->render('view_tagset_list');
				} else {
					$this->Session->setFlash(__('The Tag Set has been saved', true));
					$this->redirect(array('controller' => 'vertices', 'action'=>'view', $id));
				}
			} else {
				if ($this->RequestHandler->isAjax()) {
					$this->Session->setFlash('The Tag Set could not be saved. Please fill in the set name correctly.', 'default', array(), 'tagset');
					$this->viewPath = 'elements';
					$this->set('tagsets', $this->_getTagsets($id));
					$this->set('showform', true);					
					$this->render('view_tagset_list');
				} else {
					$this->Session->setFlash(__('The Tag Set could not be saved. Please, try again.', true));
				}
			}
		}
	}
	
	//prepare data to be saved
	function _prepareData($data) {
		if (!$this->Tagset->checkTitle($data['Tagset'], true))
			return $data; //no further checks - since validation will fail anyway
		
		//check addition of stuff
		if (isset($data['Tagset']['title']) && $data['Tagset']['title'] != '') {
			//first divert class and title
			$pos = strpos($data['Tagset']['title'], ':');
			if ($pos !== false) {
				if ($pos == 0)
					$data['Tagset']['group'] = null;
				else
					$data['Tagset']['group'] = substr($data['Tagset']['title'], 0, $pos);
				$data['Tagset']['title'] = substr($data['Tagset']['title'], $pos+1);
			} else $data['Tagset']['group'] = null;
		}
		
		//now check, if this set already exists
		$conditions = array('title' => $data['Tagset']['title'], 'group' => $data['Tagset']['group'], 'deleted' => '0');
		$list = $this->Tagset->find('list', array('conditions' => $conditions));
		
		//found entry
		if (count($list) > 0) {
			list($key) = each($list);
			if(is_numeric($key)) $data['Tagset']['id'] = $key;
		}
		
		return $data;
	}
	
	function delete_set($id) {
		//get params
		if (isset($this->params['named']['vtx']))
			$vtx = $this->params['named']['vtx'];
		else $vtx = -1;
		
		//check id first
		if (!$id) {
			if ($this->RequestHandler->isAjax()) {
				$this->Session->setFlash('Error: Invalid id for Deletion.', 'default', array(), 'tagset');
				$this->viewPath = 'elements';
				$this->set('tagsets', $this->_getTagsets($vtx));
				$this->set('id', $vtx);
				$this->render('view_tagset_list');
			} else {
				$this->Session->setFlash(__('Invalid id for Deletion', true));
				$this->redirect(array('controller' => 'vertices', 'action'=>'view', $vtx));
			}
		}
		
		//delete entry
		if ($this->Tagset->TagsetsVertex->del($id)) {
			if ($this->RequestHandler->isAjax()) {
				$this->Session->setFlash(__('Entry deleted.', true), 'default', array(), 'tagset');
				$this->viewPath = 'elements';
				$this->set('tagsets', $this->_getTagsets($vtx));
				$this->set('id', $vtx);
				$this->render('view_tagset_list');
			} else {
				$this->Session->setFlash(__('Entry deleted', true));
				$this->redirect(array('controller' => 'vertices', 'action'=>'view', $vtx));
			}
		}
		//otherwise error...
	}
	
	/**
	 * loads tagsets for a vertex id
	 */
	function _getTagsets($id) {
		$this->Tagset->bindModel(array('hasOne' => array('TagsetsVertex' => array('className' => 'TagsetsVertex'))));
		$this->Tagset->contain('TagsetsVertex');
		return $this->Tagset->find('all', array('conditions' => array('TagsetsVertex.vertex_id' => $id), 'order' => 'group, title'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Tag Set', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tagset->save($this->data)) {
				$this->Session->setFlash(__('The Tagset has been saved', true));
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash(__('The Tagset could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->Tagset->contain();
			$this->data = $this->Tagset->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Tag Set', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Tagset->saveField('deleted', 1);
		$this->Session->setFlash(__('Tag Set deleted', true));
		$this->redirect(array('action'=>'index'));
	}

	function ajax_autocomplete(){
        $this->layout = 'ajax';
        $this->cleaner = new Sanitize();
        $this->data = $this->cleaner->clean($this->data);

		//find this phrase
		if (!isset($this->data['Tagset']) && !isset($this->data['Tagset']['title'])) return false;
		$s = $this->data['Tagset']['title'];

		//search now
		$this->Tagset->contain();
		$tagsets = $this->Tagset->find('all', array(
			'fields' => array('title', 'group'),
			'conditions' => array(
				'OR' => array(
					'title LIKE' => $s.'%',
					'group LIKE' => $s.'%'
				),
				'deleted' => 0
			),
			'order' => 'group, title'
		));

        $this->set('tagsets', $tagsets);
    }
}
?>