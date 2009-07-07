<?php
/*********************************************************
 * histcross v2.0
 * File: simple_search_engine.php
 * Created: 11.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class SimpleSearchEngineController extends AppController {
	var $name = 'SimpleSearchEngine';
	var $results = null;

	var $paginate = array(
		'Vertex' => array(
			'contain' => array('VertexType' => array('fields' => array('id', 'title', 'pictogram_id'))),
			'fields' => array('id', 'title', 'pictogram_id'),
			'limit' => PERPAGE,
			'order' => array(
				'Vertex.title' => 'asc'
			),
			'conditions' => array('Vertex.deleted' => '0'),
		)
	);

	function setController($controller) {
		$this->params = $controller->params;
	}

	function _setup() {
		//Load Model of Vertices
		$this->loadModel('Vertex');
		$this->Vertex = new Vertex(); 
	}
	
	function search($s, $page) {
		$this->_setup();

		//set the search pattern
		$this->paginate['Vertex']['conditions']['Vertex.title LIKE'] = '%'.$s.'%';

		//now search the vertices
		$results = $this->paginate('Vertex');
		$this->results = array();
		
		foreach ($results as $result) {
			$this->results[] = array(
				'id' => $result['Vertex']['id'],
				'title' => $result['Vertex']['title'],
				'typetitle' => $result['VertexType']['title'],
				'pictogram_id' => $result['Vertex']['pictogram_id'],
				'url' => 'vertices',
				'relevance' => 1,
				'text' => null
			);
		}
	}
	
	function getResults() {
		return $this->results;
	}
	
	function numberOfHits() {
		return $this->params['paging']['Vertex']['count'];
	}
	
	function numberOfPages() {
		return $this->params['paging']['Vertex']['pageCount'];
	}
	
	function currentPage() {
		return $this->params['paging']['Vertex']['page'];
	}
	
	function getHighlightype() {
		return 'plain';
	}
}
?>