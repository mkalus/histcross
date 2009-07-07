<?php
/*********************************************************
 * histcross v2.0
 * File: relations_controller.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class RelationsController extends AppController {

	var $name = 'Relations';
	var $helpers = array('Html', 'Form', 'Geography', 'Ajax', 'Javascript', 'StrictAutocomplete', 'Tagcloud');
	var $paginate = array(
		'Relation' => array(
			'contain' => array('VertexFrom', 'VertexTo', 'RelationType'),
			'limit' => PERPAGE,
			'order' => array(
				'Relation.relation_type_id' => 'asc'
			),
			'conditions' => array('Relation.deleted = 0'),
		),
	);

	function index() {
		//$this->Relation->unbindModel(array('belongsTo' => array('Creator', 'Changer', 'Pictogram')), false);
		$this->set('relations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Relation.', true));
			$this->redirect(array('action'=>'index'));
		}
		//Get Related Class Information
		$this->Relation->contain(array('VertexFrom', 'VertexTo', 'RelationType' => 'RelationClass', 'Creator', 'Changer', 'Bibliography'));
		//Read Data
		$data = $this->Relation->read(null, $id);

		//Read bibliographic data - only if logged in
		$sess = $this->Session->read($this->Auth->sessionKey);
		if ($this->isAuthorized('edit'))
			$this->set('bibliography_list', $this->_getBibliography($this->Relation->Bibliography, $data['Bibliography']));
		unset($sess);

		//To and from relations as a second model :-)
		$this->loadModel('Relation');
		$this->Relation2 = new Relation();
		$this->paginate['Relation']['conditions'][1] = 'Relation.from_vertex_id = '.$data['Relation']['from_vertex_id'];
		$this->paginate['Relation']['conditions'][2] = 'Relation.relation_type_id = '.$data['Relation']['relation_type_id'];
		//Only load this if not from Ajax or if it is, then handler is the right one
		if (!$this->RequestHandler->isAjax() ||
			($this->RequestHandler->isAjax() && $this->params['named']['handle'] == 'relationsfrom')) { 
			$fromsame = $this->paginate('Relation2');
			//Workaround for problem with paging :-)
			$this->params['paging']['Relationfrom'] = $this->params['paging']['Relation'];
			$this->set('fromsame', $fromsame);
		}
		//Only load this if not from Ajax or if it is, then handler is the right one
		if (!$this->RequestHandler->isAjax() ||
			($this->RequestHandler->isAjax() && $this->params['named']['handle'] == 'relationsto')) { 
			$this->paginate['Relation']['conditions'][1] = 'Relation.to_vertex_id = '.$data['Relation']['to_vertex_id'];
			//$this->paginate['Relation']['conditions'][2] = 'Relation.relation_type_id = '.$data['Relation']['relation_type_id'];
			$tosame = $this->paginate('Relation2');
			$this->set('tosame', $tosame);
			$this->params['paging']['Relationto'] = $this->params['paging']['Relation'];
		}
		//to set the links correctly, options[0] has to be set by hand for some reason...
		$this->params['paging']['Relation']['options'][0] = $id;
		
		if ($this->RequestHandler->isAjax()) {
			$this->viewPath = 'elements';
			//Which element?
			switch($this->params['named']['handle']) {
				case 'relationsto':
					$this->set('elementtitle', 'Similar Relations to right Vertex');
					$this->set('useajax', true);
					$this->set('uniqhandle', 'to');
					$this->set('relations', $tosame);
					$this->render('list_relations');
					break;
				case 'relationsfrom':
					$this->set('elementtitle', 'Similar Relations from left Vertex');
					$this->set('useajax', true);
					$this->set('uniqhandle', 'from');
					$this->set('relations', $fromsame);
					$this->render('list_relations');
					break;
			}
		} else {
			$this->set('relation', $data);
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->Relation->create();
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->Relation->save($this->data)) {
				$this->_updateIndexerNotification();
				$this->Session->setFlash(__('The Relation has been saved', true));
				if (isset($this->Relation->id))
					$this->redirect(array('action'=>'view', $this->Relation->id));
				else $this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Relation could not be saved. Please, try again.', true));
			}
		}
		$this->_setPossibleRelation();
		$this->_getRelatedVertices();
		$relationTypes = $this->Relation->RelationType->find('list', array('recursive' => 0, 'fields' => array('RelationType.id', 'RelationType.title_from', 'RelationClass.title'), 'conditions' => array('RelationType.deleted' => '0')));
		$this->set(compact('relationTypes'));
	}
	
	/**
	 * Set possible relation sent by a vertex-view-page
	 */
	function _setPossibleRelation() {
		//check for form data
		if(isset($this->params['url']) && isset($this->params['url']['possible_relation'])
			 && isset($this->params['url']['vertex_id'])
			 && is_numeric($this->params['url']['vertex_id'])) {
			 	//'f' or 't' as suffix?
			 	$fromto = substr($this->params['url']['possible_relation'], -1);
			 	
		 		$this->data['Relation']['relation_type_id'] = substr($this->params['url']['possible_relation'], 0, -1);
			 	if ($fromto == 'f')
			 		$this->data['Relation']['from_vertex_id'] = $this->params['url']['vertex_id'];
			 	if ($fromto == 't')
			 		$this->data['Relation']['to_vertex_id'] = $this->params['url']['vertex_id'];
			 }
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Relation', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->_handleCreatorChanger(); //add creator/changer to data
			//delete this value when editing
			$this->data['Relation']['inference_parent_id'] = null;
			if ($this->Relation->save($this->data)) {
				$this->_updateIndexerNotification();
				$this->Session->setFlash(__('The Relation has been saved', true));
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash(__('The Relation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->Relation->contain();
			$this->data = $this->Relation->read(null, $id);
		}
		$this->_getRelatedVertices();
		$relationTypes = $this->Relation->RelationType->find('list', array('recursive' => 0, 'fields' => array('RelationType.id', 'RelationType.title_from', 'RelationClass.title'), 'conditions' => array('RelationType.deleted' => '0')));
		$this->set(compact('relationTypes'));
	}
	
	/**
	 * loader for Vertex names
	 */
	function _getRelatedVertices() {
			if (!isset($this->data['Relation'])) return;
			
			//populate the input fields with entries:
	 		//Load Model of Vertices
			$this->loadModel('Vertex');
			$this->Vertex = new Vertex();
			$this->Vertex->contain();
			if (isset($this->data['Relation']['from_vertex_id']) && is_numeric($this->data['Relation']['from_vertex_id'])) {
				$from = $this->Vertex->find('list', array('conditions' => array('Vertex.id' => $this->data['Relation']['from_vertex_id'])));
				$this->data['Relation']['relation_from_vertex'] = array_pop($from);
			}
			if (isset($this->data['Relation']['to_vertex_id']) && is_numeric($this->data['Relation']['to_vertex_id'])) {
				$to = $this->Vertex->find('list', array('conditions' => array('Vertex.id' => $this->data['Relation']['to_vertex_id'])));
				$this->data['Relation']['relation_to_vertex'] = array_pop($to);
			}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Relation', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Relation->saveField('deleted', 1);
		$this->Session->setFlash(__('Relation deleted', true));
		$this->_updateIndexerNotification();
		$this->redirect(array('action'=>'index'));
	}

	/**
	 * Tell the indexer that something has changed - called by add, edit, delete
	 */
	function _updateIndexerNotification() {
		//Load Model
		$this->loadModel('TableUpdate');
		$tableUpdate = new TableUpdate();
		
		$saveString = array('TableUpdate' => array(
			'id' => 2,
			'status' => 1
		));
		
		$tu = $tableUpdate->save($saveString);
	}

	function viewglobe($id) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Relation', true));
			$this->redirect(array('action'=>'index'));
		}
		//if not Ajax -> view page with globe
		if (!$this->RequestHandler->isAjax()) {
			$this->redirect(array('action'=>'view', $id, 'showglobe' => 'yes'));
		}
		//Read data
		$this->Relation->contain();
		$this->set('data', $this->Relation->read(null, $id));
		$this->set('model', 'Relation');
	}
	
	function edit_bibliography() {
		parent::edit_bibliography($this->Relation->BibliographiesRelation);
	}
	
	function add_bibliography() {
		parent::add_bibliography('Relation', $this->Relation, $this->Relation->Bibliography, $this->Relation->BibliographiesRelation);
	}

	function delete_bibliography() {
		parent::delete_bibliography('Relation', $this->Relation, $this->Relation->Bibliography, $this->Relation->BibliographiesRelation);
	}
	
	function aggregate_cloud() {
		$from = $this->Relation->aggregateTagcloudFrom();
		$to = $this->Relation->aggregateTagcloudTo();
		
		$this->set('fromtags', $from['tags']);
		$this->set('totags', $to['tags']);
		$this->set('fromids', $from['idlist']);
		$this->set('toids', $to['idlist']);
	}
	
	/**
	 * renders a list of possible inferences
	 */
	function possible_inferences($id) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Relation for Inference Search', true));
			$this->redirect(array('action'=>'index'));
		}
		//Get Related Class Information
		$this->Relation->contain(array('VertexFrom', 'VertexTo', 'RelationType' => 'RelationClass'));
		//Read Data
		$relation = $this->Relation->read(null, $id);

		//was anything found?
		if (count($relation) == 0) {
			$this->Session->setFlash(__('No fitting Relation found for Inference Search', true));
			$this->redirect(array('action'=>'index'));
		}

		$this->set('relation', $relation);
		//set possible inferences
		$this->_setPossibleInferences($relation);

		if ($this->RequestHandler->isAjax()) {
			$this->viewPath = 'elements';
			$this->render('view_possible_inferences');
		}
	}
	
	/**
	 * Set possible inferences
	 */
	function _setPossibleInferences($relation) {
		//find inferences
		$this->Relation->RelationType->Inference1->contain(array(
			'InferenceType' => array('fields' => array('id', 'is_xy', 'connects', 'img')),
			'RelationType3' => array('fields' => array('title_from', 'title_to')),
		));
		$inferences = $this->Relation->RelationType->Inference1->find('all', array('conditions' => array('Inference1.deleted' => 0, 'Inference1.p1_id' => $relation['Relation']['relation_type_id'])));
		
		if (count($inferences) == 0) {
			$this->set('warning', __('No Inferences found for this Relation', true));
			$this->set('inferences', null);
		} else {
			//get possible inferences
			$list = $this->_getInferList($relation, $inferences);
			$this->set('inferences', $list);
			if (count($list) == 0) $this->set('warning', __('No possible Inferences found', true));
			else $this->set('warning', null); //no warnings...
		}
	}
	
	function _getInferList(&$relation, &$inferences) {
		$list = array(); //empty list
		
		foreach($inferences as $inference) {
			$newl = $this->_getOneInfer($relation, $inference);
			$list = array_merge($list, $newl);
		}
		
		return $list;
	}
	
	function _getOneInfer(&$relation, &$inference) {
		$matches = array(); //wird zurückgegeben

		//prepare sql query
		//xy or yx?
		if ($inference['InferenceType']['is_xy'] == 1) {
			$from_id = $relation['Relation']['from_vertex_id'];
			$to_id = $relation['Relation']['to_vertex_id'];
			$from_title = $relation['VertexFrom']['title'];
			$to_title = $relation['VertexTo']['title'];
		} else {
			$from_id = $relation['Relation']['to_vertex_id'];
			$to_id = $relation['Relation']['from_vertex_id'];
			$from_title = $relation['VertexTo']['title'];
			$to_title = $relation['VertexFrom']['title'];
		}
		//correct a direction
		if ($inference['Inference1']['p1_dir_from'] == 1) {
			$froma = $this->_straight($inference['Inference1']['p1_dir_from']);
			$toa = $this->_opposite($inference['Inference1']['p1_dir_from']);
		} else {
			$froma = $this->_opposite($inference['Inference1']['p1_dir_from']);
			$toa = $this->_straight($inference['Inference1']['p1_dir_from']);
		}
		//correct b direction
		if ($inference['Inference1']['p2_dir_from'] == 1) {
			$fromb = $this->_straight($inference['Inference1']['p2_dir_from']);
			$tob = $this->_opposite($inference['Inference1']['p2_dir_from']);
		} else {
			$fromb = $this->_opposite($inference['Inference1']['p2_dir_from']);
			$tob = $this->_straight($inference['Inference1']['p2_dir_from']);
		}
		
		//some shortcuts
		$p1_id = $inference['Inference1']['p1_id']; //relation types
		$p2_id = $inference['Inference1']['p2_id'];
		
		//construct SQL command - somewhat complicated :-)
		$sql = "SELECT z.id, z.title ";
		$sql .= "FROM hc_relations AS a, hc_relations AS b, hc_vertices AS z ";
		$sql .= "WHERE a.${froma}_vertex_id = $from_id AND "; //node from x/a
		$sql .= "a.relation_type_id = $p1_id AND "; //relation type of edge a
		$sql .= "a.${toa}_vertex_id = $to_id AND "; //node to y/a
		$sql .= "b.${fromb}_vertex_id = $from_id AND "; //node from (x|y)/b
		$sql .= "b.relation_type_id = $p2_id AND "; //relation type of edge b
		$sql .= "b.${tob}_vertex_id = z.id AND "; //node from (x|y)/b
		$sql .= "a.deleted = 0 AND b.deleted = 0 AND z.deleted = 0;";

		//execute sql
		$possible_vtx = $this->Relation->query($sql);
		
		if (count($possible_vtx) == 0) return array(); //no hits
		
		//get some other data
		$possible_relation_type = $inference['Inference1']['p3_id'];
		$possible_relation_dir = $inference['Inference1']['p3_dir_from'];
		$from = $inference['RelationType3']['title_from'];
		$to = $inference['RelationType3']['title_to'];
		$connectsf = substr($inference['InferenceType']['connects'], 0, 1); //connects which nodes?
		$connectst = substr($inference['InferenceType']['connects'], 1); //connects which nodes?

		//traverse possible hits
		foreach($possible_vtx as $hit) {
			$myfrom = $this->xyorz($connectsf, $from_id, $from_title, $to_id, $to_title, $hit['z']['id'], $hit['z']['title']);
			$myto = $this->xyorz($connectst, $from_id, $from_title, $to_id, $to_title, $hit['z']['id'], $hit['z']['title']);
			
			//check logic - no circular references
			if ($myfrom['id'] == $myto['id']) continue;
			
			//create info array
			$info = array('from_id' => $myfrom['id'],
				'to_id' => $myto['id'],
				'from_title' => $myfrom['title'],
				'to_title' => $myto['title'],
				'relation_type_id' => $possible_relation_type,
				'relation_title' => ($possible_relation_dir==1?$from:$to),
				'exists' => false
				);

			//check, if reference exists already
			$sql = "SELECT id FROM hc_relations WHERE deleted = 0 AND relation_type_id = '".$possible_relation_type."' AND ((from_vertex_id = '".$myfrom['id']."' AND to_vertex_id = '".$myto['id']."') OR (from_vertex_id = '".$myto['id']."' AND to_vertex_id = '".$myfrom['id']."'));";
			$check = $this->Relation->query($sql);
			
			if(count($check) > 0) $info['exists'] = true;
			
			//Add match
			$matches[] = $info;
			//echo $myfrom['title'].' '.($possible_relation_dir==1?$from:$to).' '.$myto['title'].'<br />';
		}

		return $matches;
	}

	//to <=> from
	function _straight($from) { if ($from == 1) return 'from'; else return 'to'; }
	function _opposite($from) { if ($from == 1) return 'to'; else return 'from'; }
	
	//return x, y or z
	function xyorz($type, $from_id, $from_title, $to_id, $to_title, $z_id, $z_title) {
		switch($type) {
			case 'x':
				return array('id' => $from_id, 'title' => $from_title);
			case 'y':
				return array('id' => $to_id, 'title' => $to_title);
			case 'z':
				return array('id' => $z_id, 'title' => $z_title);
		}
		return false;
	}
	
	/**
	 * Adds an inference
	 */
	function add_inference($id) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Relation.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		//get values and validate
		$error = false;
		if (isset($this->params) && isset($this->params['named'])) {
			if (!isset($this->params['named']['from_id']) ||
				!isset($this->params['named']['to_id']) ||
				!isset($this->params['named']['relation_type_id']))
				$error = true;
		} else $error = true;
		
		if ($error) {
			$this->Session->setFlash(__('Invalid parameters.', true));
			$this->redirect(array('action'=>'index'));
		}

		//add inference
		$this->Relation->create();
		$this->_handleCreatorChanger(); //add creator/changer to data
		$this->data['Relation']['relation_type_id'] = $this->params['named']['relation_type_id'];
		$this->data['Relation']['from_vertex_id'] = $this->params['named']['from_id'];
		$this->data['Relation']['to_vertex_id'] = $this->params['named']['to_id'];
		$this->data['Relation']['comment'] = __('Automatically created inference based on relation #', true).$id;
		$this->data['Relation']['inference_parent_id'] = $id;
		
		//validation
		$this->Relation->set($this->data);
		if (!$this->Relation->validates()) {
			$this->Session->setFlash(__('Unable to add inference - error in validation of data.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		//everything ok: add inference
		$this->Relation->save($this->data);
		
		//output is done in a very simple way...
		if ($this->RequestHandler->isAjax()) {
			$this->viewPath = 'elements';
			$this->render('view_ok_icon');
		} else {
			$this->Session->setFlash(__('Inferred relation was successfully added.', true));
			$this->redirect(array('controller' => 'relations', 'action' => 'view', $id));
		}
	}
}
?>