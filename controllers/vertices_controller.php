<?php
/*********************************************************
 * histcross v2.0
 * File: vertices_controller.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class VerticesController extends AppController {

	var $name = 'Vertices';
	var $helpers = array('Html', 'Form', 'Geography');
	var $paginate = array(
		'Vertex' => array(
			'contain' => array('VertexType'),
			'limit' => PERPAGE,
			'order' => array(
				'Vertex.title' => 'asc'
			),
			'conditions' => 'Vertex.deleted = 0',
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
		$this->set('vertices', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Vertex.', true));
			$this->redirect(array('action'=>'index'));
		}
		//Read data
		$this->Vertex->contain(array('VertexType' => 'VertexClass', 'Creator', 'Changer', 'Bibliography', 'Tagset'));
		$data = $this->Vertex->read(null, $id);
		//in case of easy pagination
		$this->paginate['Relation']['conditions'][] = array('OR' => array('Relation.from_vertex_id = '.$id, 'Relation.to_vertex_id = '.$id));
		//this handles the complex part of pagination in this case - ugly hack, but works...
		$this->set('relations', $this->_paginateNormalized($id));
		//pr($this->params);
		
		if ($this->RequestHandler->isAjax()) {
			$this->viewPath = 'elements';
			$this->set('elementtitle', 'Related Relations');
			$this->set('useajax', true);
			$this->render('list_relations');
		} else {
			$this->set('vertex', $data);
			//Add this vertex to list
			$this->_writeVertexToSession($data['Vertex']);
			//Load session for possible form data
			$sess = $this->Session->read($this->Auth->sessionKey);
			//Read bibliographic data - only if logged in
			if ($this->isAuthorized('edit')) {
				$this->set('bibliography_list', $this->_getBibliography($this->Vertex->Bibliography, $data['Bibliography']));
				$this->_setRelationTypeDropdowns($data['Vertex']['vertex_type_id']);
			}
			unset($sess);
		}
	}
	
	/**
	 * Sets the data for the "Add relation"-dropdown in views 
	 */
	function _setRelationTypeDropdowns($vertex_type_id) {
		$list = array();
		$vertex_type_id = ','.mysql_escape_string($vertex_type_id).',';
		$q = $this->Vertex->query("SELECT hc_relation_types.id, title_from, title_to, vertex_types_from, vertex_types_to, hc_relation_classes.title FROM hc_relation_types, hc_relation_classes WHERE hc_relation_classes.id = hc_relation_types.relation_class_id AND hc_relation_types.deleted = 0 AND hc_relation_classes.deleted = 0 AND (vertex_types_from = '' OR vertex_types_to = '' OR CONCAT(',', vertex_types_from, ',') LIKE '%".$vertex_type_id."%' OR CONCAT(',', vertex_types_to, ',') LIKE '%".$vertex_type_id."%') ORDER BY title");
		foreach($q as $val) {
			//to prevent double entries
			if ($val['hc_relation_types']['title_from'] == $val['hc_relation_types']['title_to']) {
				if ($val['hc_relation_types']['vertex_types_from'] == '' || strpos(','.$val['hc_relation_types']['vertex_types_from'].',', $vertex_type_id) !== false)
					$list[$val['hc_relation_types']['id'].'f'] = $val['hc_relation_classes']['title'].': '.$val['hc_relation_types']['title_from'];
				elseif ($val['hc_relation_types']['vertex_types_to'] == '' || strpos(','.$val['hc_relation_types']['vertex_types_to'].',', $vertex_type_id) !== false)
					$list[$val['hc_relation_types']['id'].'t'] = $val['hc_relation_classes']['title'].': '.$val['hc_relation_types']['title_to'];
			} else { //standard case - possibly two entries
				if ($val['hc_relation_types']['vertex_types_from'] == '' || strpos(','.$val['hc_relation_types']['vertex_types_from'].',', $vertex_type_id) !== false)
					$list[$val['hc_relation_types']['id'].'f'] = $val['hc_relation_classes']['title'].': '.$val['hc_relation_types']['title_from'];
				if ($val['hc_relation_types']['vertex_types_to'] == '' || strpos(','.$val['hc_relation_types']['vertex_types_to'].',', $vertex_type_id) !== false)
					$list[$val['hc_relation_types']['id'].'t'] = $val['hc_relation_classes']['title'].': '.$val['hc_relation_types']['title_to'];
			}
		}
		
		$this->set('relation_types', $list);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Vertex->create();
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->Vertex->save($this->data)) {
				$this->_updateIndexerNotification();
				$this->Session->setFlash(__('The Vertex has been saved', true));
				if (isset($this->Vertex->id))
					$this->redirect(array('action'=>'view', $this->Vertex->id));
				else $this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Vertex could not be saved. Please, try again.', true));
			}
		}
		$vertexTypes = $this->Vertex->VertexType->find('list', array('conditions' => array('VertexType.deleted' => '0')));
		$pictograms = $this->Vertex->Pictogram->find('list');
		$this->set(compact('vertexTypes', 'pictograms'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Vertex', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->Vertex->save($this->data)) {
				$this->_updateIndexerNotification();
				$this->Session->setFlash(__('The Vertex has been saved', true));
				//$this->redirect(array('action'=>'index'));
				$this->redirect(array('action'=>'view', $id));
			} else {
				$this->Session->setFlash(__('The Vertex could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->Vertex->contain();
			$this->data = $this->Vertex->read(null, $id);
		}
		$vertexTypes = $this->Vertex->VertexType->find('list', array('conditions' => array('VertexType.deleted' => '0')));
		$pictograms = $this->Vertex->Pictogram->find('list');
		$this->set(compact('vertexTypes', 'pictograms'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Vertex', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Vertex->saveField('deleted', 1);
		$this->Session->setFlash(__('Vertex deleted', true));
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
			'id' => 1,
			'status' => 1
		));
		
		$tu = $tableUpdate->save($saveString);
	}
	
	function viewglobe($id) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Vertex', true));
			$this->redirect(array('action'=>'index'));
		}
		//if not Ajax -> view page with globe
		if (!$this->RequestHandler->isAjax()) {
			$this->redirect(array('action'=>'view', $id, 'showglobe' => 'yes'));
		}
		//Read data
		$this->Vertex->contain();
		$this->set('data', $this->Vertex->read(null, $id));
		$this->set('model', 'Vertex');
	}
	
	/**
	 * Order related relations by hand... very ugly hack :-)
	 */
	function _paginateNormalized($id) {
		//Error handling
		if (!$id) return $this->view(null);
		
		//Load Model of Relations
		$this->loadModel('Relation');
		$this->Relation = new Relation(); 
		
		//Retreive sort stuff
		if (key_exists('sort', $this->params['named']))
			$sort = $this->params['named']['sort'];
		else $sort = 'Relation.relation_type_id';
		if (key_exists('direction', $this->params['named']))
			$sortdirection = $this->params['named']['direction'];
		else $sortdirection = 'asc';
		if (key_exists('page', $this->params['named']))
			$page = $this->params['named']['page'];
		else $page = 1;

		//First the easy cases
		if ($sort == 'start_time' || $sort == 'stop_time' || $sort == 'Relation.start_time' || $sort == 'Relation.stop_time')
			return $this->paginate('Relation'); //normal pagination here
		
		//presort entries to make integration easier later
		switch ($sort) {
			case 'VertexFrom.title':
				$fromsort = 'VertexFrom.title';
				$tosort = 'VertexTo.title';
				break;
			case 'RelationType.title_from':
				$fromsort = 'RelationType.title_from';
				$tosort = 'RelationType.title_to';
				break;
			case 'VertexTo.title':
				$fromsort = 'VertexTo.title';
				$tosort = 'VertexFrom.title';
				break;
			default:
				$fromsort = 'Relation.relation_type_id';
				$tosort = 'Relation.relation_type_id';
		}
		
		//now the hard part... manual retreival of data
		$fromdata = $this->Relation->find('all', array(
			'conditions' => array(
				'Relation.deleted' => '0',
				'VertexFrom.deleted' => '0',
				'VertexTo.deleted' => '0',
				'RelationType.deleted' => '0',
				'Relation.from_vertex_id' => $id
				),
			'contain' => array('VertexFrom', 'VertexTo', 'RelationType'),
			'contain' => null,
			'order' => array(
				$fromsort => $sortdirection
			),
		));
		$todata = $this->Relation->find('all', array(
			'conditions' => array(
				'Relation.deleted' => '0',
				'VertexFrom.deleted' => '0',
				'VertexTo.deleted' => '0',
				'RelationType.deleted' => '0',
				'Relation.to_vertex_id' => $id
				),
			'contain' => array('VertexFrom', 'VertexTo', 'RelationType'),
			'contain' => null,
			'order' => array(
				$tosort => $sortdirection
			),
		));
		$this->_switchFields($todata);
		
		//merge arrays
		$sortarray =  array(); //Array for multisort
		foreach($fromdata as $dataentry) {
			//Sortkey-Factor
			switch ($sort) {
				case 'VertexFrom.title':
					$sortarray[] = $dataentry['VertexFrom']['title'];
					break;
				case 'RelationType.title_from':
					$sortarray[] = $dataentry['RelationType']['title_from'];
					break;
				case 'VertexTo.title':
					$sortarray[] = $dataentry['VertexTo']['title'];
					break;
				default:
					$sortarray[] = $dataentry['Relation']['relation_type_id'];
			}
		}
		foreach($todata as $dataentry) {
			//Sortkey-Factor
			switch ($sort) {
				case 'VertexFrom.title':
					$sortarray[] = $dataentry['VertexFrom']['title'];
					break;
				case 'RelationType.title_from':
					$sortarray[] = $dataentry['RelationType']['title_from'];
					break;
				case 'VertexTo.title':
					$sortarray[] = $dataentry['VertexTo']['title'];
					break;
				default:
					$sortarray[] = $dataentry['Relation']['relation_type_id'];
			}
		}
		$data = am($fromdata, $todata);
		//Sort direction
		if ($sortdirection == 'desc') $mydir = SORT_DESC;
		else $mydir = SORT_ASC;
		array_multisort($sortarray, $mydir, $data); //sort the data array according to sortkeys
		$count = count($data);
		
		//Range issues...
		if (($page-1)*PERPAGE >= $count || $page <= 0) $page = 1;
		
		//Shift members off array
		for ($i = 0; $i < ($page-1)*PERPAGE; $i++)
			array_shift($data);
		$remaining = count($data);
		if ($remaining > PERPAGE) {
			$i = 0;
			for ($i = 0; $i < $remaining-PERPAGE; $i++)
				array_pop($data);
			$remaining = PERPAGE;
		}
		
		$pageCount = ceil($count/PERPAGE);
		
		//Set paging parameters
		$this->params['paging']['Relation']['page'] = $page;
		$this->params['paging']['Relation']['current'] = $remaining;
		$this->params['paging']['Relation']['count'] = $count;
		$this->params['paging']['Relation']['prevPage'] = ($page != 1?true:false);
		$this->params['paging']['Relation']['nextPage'] = ($page != $pageCount?true:false);
		$this->params['paging']['Relation']['pageCount'] = $pageCount;
		$this->params['paging']['Relation']['options']['limit'] = PERPAGE;
		$this->params['paging']['Relation']['options']['step'] = 1;
		$this->params['paging']['Relation']['options'][0] = $id;
		$this->params['paging']['Relation']['options']['order'] = array($sort => $sortdirection);
		$this->params['paging']['Relation']['defaults']['limit'] = PERPAGE;
		$this->params['paging']['Relation']['defaults']['step'] = 1;
		$this->params['paging']['Relation']['defaults']['order'] = array($sort => $sortdirection);
		$this->params['paging']['Relation']['order'] = array($sort => $sortdirection);
		$this->paginate['Relation']['order']['sort'] = $sort;
		$this->paginate['Relation']['order']['direction'] = $sortdirection;
		return ($data);
	}
	
	/**
	 * Switch fields in relation set - used by _paginateNormalized
	 */
	function _switchFields(&$data) {
		foreach($data as &$dataentry) {
			//$fromvertexid = $dataentry['Relation']['from_vertex_id'];
			//$fromvertex = $dataentry['VertexFrom'];
			$tovertexid = $dataentry['Relation']['to_vertex_id'];
			$tovertex = $dataentry['VertexTo'];
			$titleto = $dataentry['RelationType']['title_to'];
			
			$dataentry['Relation']['to_vertex_id'] = $dataentry['Relation']['from_vertex_id'];
			$dataentry['VertexTo'] = $dataentry['VertexFrom'];
			$dataentry['Relation']['from_vertex_id'] = $tovertexid;
			$dataentry['VertexFrom'] = $tovertex;
			$dataentry['RelationType']['title_to'] = $dataentry['RelationType']['title_from'];
			$dataentry['RelationType']['title_from'] = $titleto;
		}
	}

	function edit_bibliography() {
		parent::edit_bibliography($this->Vertex->BibliographiesVertex);
	}
	
	function add_bibliography() {
		parent::add_bibliography('Vertex', $this->Vertex, $this->Vertex->Bibliography, $this->Vertex->BibliographiesVertex);
	}
	
	function delete_bibliography() {
		parent::delete_bibliography('Vertex', $this->Vertex, $this->Vertex->Bibliography, $this->Vertex->BibliographiesVertex);
	}

	function ajax_autocomplete(){
        $this->layout = 'ajax';
        $this->cleaner = new Sanitize();
        $this->data = $this->cleaner->clean($this->data);
       
		//to or from?
		if (isset($this->params['form']['direction'])) $direction = $this->params['form']['direction'];
		else $direction = 'from';
		if ($direction != 'from' && $direction != 'to') $direction = 'from'; //security

		//find this phrase
		if (!isset($this->data['Relation']) && !isset($this->data['Relation']['relation_'.$direction.'_vertex'])) return false;
		$s = $this->data['Relation']['relation_'.$direction.'_vertex'];

		//only find certain types
       	if (isset($this->params['form']['relationType']) && is_numeric($this->params['form']['relationType'])) {
       		$searchType = $this->params['form']['relationType'];
       		
	 		//Load Model of Relations
			$this->loadModel('RelationType');
			$this->RelationType = new RelationType();
			$this->RelationType->contain();
			$find = $this->RelationType->find('all', array(
				'conditions' => array('RelationType.id' => $searchType),
				'fields' => array('RelationType.vertex_types_'.$direction),
				)
			);
			
			if (isset($find[0]) && isset($find[0]['RelationType']['vertex_types_'.$direction]))
				$searchvalues = $find[0]['RelationType']['vertex_types_'.$direction];
			else $searchvalues = '';
			
			if ($searchvalues != '') $searchvalues = split(',', $searchvalues);
       	} else $searchvalues = '';
       
		//conditions
		$conditions = array(
					'Vertex.deleted' => '0',
					'Vertex.title LIKE' => '%'.$s.'%'
				);
		
		//add to search string
		if (is_array($searchvalues)) $conditions['Vertex.vertex_type_id'] = $searchvalues;
 
 		//find the hits!
        $this->Vertex->contain(array('VertexType' => array('fields' => 'VertexType.pictogram_id')));
        $vertices = $this->Vertex->find('all', array(
				'fields' => array('Vertex.id', 'Vertex.title', 'Vertex.pictogram_id', 'VertexType.pictogram_id'),
				'conditions' => $conditions,
				'limit' => '0,20',
				'order' => 'Vertex.title'
	       	)
        );

        $this->set('vertices', $vertices);
    }
    
    function _writeVertexToSession($data) {
    	//retreive data from session
		if ($this->Session->check('VertexList')) {
			$vertex_list = $this->Session->read('VertexList');
			if (!is_array($vertex_list)) $vertex_list = array();
		} else $vertex_list = array();
		
		//truncate title
		$title = $data['title'];
		if (strlen($title) > 25) {
			if (function_exists('mb_substr')) //Multibyte-Compatible
				$title = mb_substr($title, 0, 24, Configure::read('App.encoding')).'...';
			else
				$title = substr($title, 0, 24).'...';
		}

		//The 'x' in the keys prevents them to be converted to numbers
		//key exists in array? -> remove it
		if (key_exists($data['id'].'x', $vertex_list))
			unset($vertex_list[$data['id'].'x']); //remove key
		//add new key to array
		$vertex_list[$data['id'].'x'] = array('title' => $title, 'pictogram_id' => $data['pictogram_id'], 'id' => $data['id']);
		
		//shorten array to 10 elements
		$len = count($vertex_list);
		for ($i = 10; $i < $len; $i++)
			array_shift($vertex_list);
		
		//save data to session
		$this->Session->write('VertexList', $vertex_list);
    }
}
?>