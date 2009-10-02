<?php
/*********************************************************
 * histcross v2.0
 * File: sphinx_search_engine.php
 * Created: 11.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

App::import('Vendor', 'sphinxapi');

define ( 'HIT_VERTEX',		0 );
define ( 'HIT_RELATION',	1 );

class SphinxSearchEngineController extends AppController {
	var $cl; //Sphinx client
	var $name = 'SimpleSearchEngine';
	var $results = null;
	var $searchwords = null;
	var $numhits = 0;
	var $numberOfPages = 0;
	var $page = 1;
	var $start = 0, $stop = 0;

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

	function search($s, $page) {
		//check, what kind of search the user wants
		if (Configure::read('HC.SphinxRunType') == 'atsearch')
			$this->updateSearch();
		
		$this->searchwords = $s;
		$this->cl = new SphinxClient(); //create new client
		
		//commit search and sort hits
		$this->_getSphinxHits();
		
		//check Pages, etc.
		$this->_fixPages($page);
		
		//truncate hit list to current page
		$this->_truncateHitList();
		
		//convert hits to actual matches
		$this->_convertHitstoEntries();
	}

	function getResults() {
		return $this->results;
	}
	
	function numberOfHits() {
		return $this->numhits;
	}
	
	function numberOfPages() {
		return $this->numberOfPages;
	}
	
	function currentPage() {
		return $this->page;
	}

	function getHighlightype() { //returns plain or soundex or something else...
		return Configure::read('HC.SphinxIndex');
	}

	/**
	 * Run the indexer if needed
	 */
	function updateSearch() {
		//check for pid file, if needed
		$pid = Configure::read('HC.SphinVarRun');
		if ($pid != '' && !file_exists($pid)) {
			echo 'No pid file '.$pid.' found!';
			return;
		}

		//load Model
		$this->loadModel('TableUpdate');
		$tableUpdate = new TableUpdate();
		
		//check for updates
		$data = $tableUpdate->read(null, 1);
		if ($data['TableUpdate']['status'] == 1) $vupdate = true;
		else $vupdate = false;
		
		$data = $tableUpdate->read(null, 2);
		if ($data['TableUpdate']['status'] == 1) $rupdate = true;
		else $rupdate = false;
				
		//update vertices
		if ($vupdate) {
			exec(Configure::read('HC.SphinxIndexer').' --quiet --config '.
				Configure::read('HC.SphinxConf').' --rotate '.
				Configure::read('HC.SphinxVertices'));
				$saveString = array('TableUpdate' => array(
					'id' => 1,
					'status' => 0
				));
				
				$tu = $tableUpdate->save($saveString);
		}
		
		//update relations
		if ($rupdate) {
			exec(Configure::read('HC.SphinxIndexer').' --quiet --config '.
				Configure::read('HC.SphinxConf').' --rotate '.
				Configure::read('HC.SphinxRelations'));
				$saveString = array('TableUpdate' => array(
					'id' => 2,
					'status' => 0
				));
				
				$tu = $tableUpdate->save($saveString);
		}
	}
	
	/**
	 * Main query function for Sphinx - core of the search function
	 */	
	function _getSphinxHits($mode = SPH_MATCH_ALL, $vertextypes = false, $relationtypes = false) {
		//get objects: weights are title, comment, typename
		$vtx = $this->_queryIndex(Configure::read('HC.SphinxVertices'), $mode, $vertextypes, array(30, 2, 5));
		//get relations: weights are a.title, b.title, title_from, title_to, comment
		$rel = $this->_queryIndex(Configure::read('HC.SphinxRelations'), $mode, $relationtypes, array(5, 5, 2, 2, 10));

		//now sort the arrays into one sorter array to get page-wise hits
		$hits = array();
		$this->numhits = 0;
		$objelem = 0;
		$relelem = 0;

		//get initial values
		if (is_array($vtx) && $vtx['total_found'] > 0) {
			$this->numhits += $vtx['total_found'];
			$vtxelem = each ($vtx['matches']);
			$vtxmax = $vtx['matches'][$vtxelem['key']]['weight'];
		} else $vtxmax = 0;
		if (is_array($rel) && $rel['total_found'] > 0) {
			$this->numhits += $rel['total_found'];
			$relelem = each ($rel['matches']);
			$relmax = $rel['matches'][$relelem['key']]['weight'];
		} else $relmax = 0;

		if ($this->numhits == 0) return; //no hits...

		//sort both arrays into hitarray		
		while ($vtxmax > 0 || $relmax > 0) {
			//no see which element is closer
			if ($vtxmax >= $relmax) {
				//add element to hit array
				$hits[] = array(
					'type' => HIT_VERTEX,
					'id' => $vtxelem['key'],
					'relevance' => $vtx['matches'][$vtxelem['key']]['weight'],
					'url' => 'vertices'
				);
				//get next element
				$vtxelem = each ($vtx['matches']);
				if (!is_array($vtxelem)) $vtxmax = 0;
				else $vtxmax = $vtx['matches'][$vtxelem['key']]['weight'];
			}
			if ($relmax > $vtxmax) {
				//add element to hit array
				$hits[] = array(
					'type' => HIT_RELATION,
					'id' => $relelem['key'],
					'relevance' => $rel['matches'][$relelem['key']]['weight'],
					'url' => 'relations'	
				);
				//get next element
				$relelem = each ($rel['matches']);
				if (!is_array($relelem)) $relmax = 0;
				else $relmax = $rel['matches'][$relelem['key']]['weight'];
			}
		}
		
		$this->results = $hits;
	}

	/**
	 * retrieve specific index
	 */
	function _queryIndex($index, $mode, $filter, $weights) {
		//Initialize search
		$this->cl->SetServer(Configure::read('HC.SphinxHost'), (int)Configure::read('HC.SphinxPort')); //server to look at
		//Weights on: title, comment, typename
		$this->cl->SetWeights($weights);
		$this->cl->SetMatchMode($mode);
		$this->cl->SetLimits(0, 1000, 1000); //Maximum hits, first get all hits, we will sort the pages later
		if (is_array($filter))
			$this->cl->SetFilter("type_id", $filter);
		//Search Sphinx!
		$res = $this->cl->Query($this->searchwords, $index);
		
		if ($res === false) //error?
			die('Sphinx search engine error: '.$this->cl->GetLastError());

		return $res;
	}
	
	/**
	 * sets pages, etc.
	 */
	function _fixPages($page) {
		//set page
		if (!is_numeric($page)) $this->page = 1;
		else $this->page = $page;
		
		//any hits?
		if ($this->numhits > 0) {
			$this->numberOfPages = ceil($this->numhits/PERPAGE);
			
			//check out of bounds
			if ($this->page < 1) $this->page = 1;
			elseif ($this->page > $this->numberOfPages) $this->page = $this->numberOfPages;
		} else $this->page = 1; //always set to 1, if no hits

		//where to start?
		$this->start = ($this->page-1) * PERPAGE;
		
		//where to stop?
		$this->stop = $this->page * PERPAGE;
		if ($this->stop > $this->numhits) $this->stop = $this->numhits;
	}
	
	/**
	 * truncate the list to actual hits on the current page
	 */
	function _truncateHitList() {
		//shift hits from the beginning
		for ($i = 0; $i < $this->start; $i++)
			array_shift($this->results);
		
		//how many are left?
		$count = count($this->results);
		//pop hits from the end
		for ($i = 0; $i < $count - PERPAGE; $i++)
			array_pop($this->results);
	}
	
	/**
	 * actually ask the database to retreive data to show to the user
	 */
	function _convertHitstoEntries() {
		//actual entry array
		$entries = array();

		//now divide the truncated list into vertices and relations
		$vertices = array(); $relations = array();
		foreach ($this->results as $hit) {
			if ($hit['type'] == HIT_VERTEX) {
				$vertices[] = $hit['id'];
				$entries['v'.$hit['id']] = $hit;
			} else {
				$relations[] = $hit['id'];
				$entries['r'.$hit['id']] = $hit;
			}
		}
		
		//replace array
		$this->results = $entries;
		
		//ok, now we are ready to fill the entries with more information
		//do this now:
		$this->_retrieveVertices($vertices);
		$this->_retrieveRelations($relations);
	}
	
	function _retrieveVertices($ids) {
		if (!is_array($ids) || count($ids) == 0) return;
		
		//Load Model of Vertices
		$this->loadModel('Vertex');
		$vertex = new Vertex();
		
		$vertex->contain(array('VertexType' => array('fields' => array('id', 'title', 'pictogram_id'))));
		$hits = $vertex->find('all', array('fields' => array('id', 'title', 'pictogram_id', 'comment'), 'conditions' => array('Vertex.id' => $ids)));
		
		//aggregate comments
		$comments = array();
		foreach($hits as $hit)
			if ($hit['Vertex']['comment'] != '') $comments[] = $hit['Vertex']['comment'];
			else $comments[] = '';

		//let sphinx build excerpts
		$comments = $this->_buildExcerpts($comments, Configure::read('HC.SphinxVertices'));
		
		reset($hits);
		foreach($hits as $hit) {
			$id = $hit['Vertex']['id'];
			$this->results['v'.$id]['title'] = $hit['Vertex']['title'];
			$this->results['v'.$id]['pictogram_id'] = $hit['Vertex']['pictogram_id'];
			$this->results['v'.$id]['typetitle'] = $hit['VertexType']['title'];
			$this->results['v'.$id]['text'] = array_shift($comments);
		}
	}
	
	function _retrieveRelations($ids) {
		if (!is_array($ids) || count($ids) == 0) return;
		
		//Load Model of Relations
		$this->loadModel('Relation');
		$relation = new Relation();

		$relation->contain(array('VertexFrom' => array('title'), 'VertexTo' => array('title'), 'RelationType' => array('fields' => array('title_from', 'pictogram_id'))));
		$hits = $relation->find('all', array('fields' => array('id', 'comment'), 'conditions' => array('Relation.id' => $ids)));

		//aggregate comments
		$comments = array();
		foreach($hits as $hit)
			if ($hit['Relation']['comment'] != '') $comments[] = $hit['Relation']['comment'];
			else $comments[] = '';
		//let sphinx build excerpts
		$comments = $this->_buildExcerpts($comments, Configure::read('HC.SphinxRelations'));
		
		reset($hits);
		foreach($hits as $hit) {
			$id = $hit['Relation']['id'];
			$this->results['r'.$id]['title'] = $hit['VertexFrom']['title'].' ⇒ '.$hit['RelationType']['title_from'].' ⇒ '.$hit['VertexTo']['title'];
			$this->results['r'.$id]['pictogram_id'] = $hit['RelationType']['pictogram_id'];
			//$this->results['r'.$id]['typetitle'] = $hit['RelationType']['title_from'];
			$this->results['r'.$id]['text'] = array_shift($comments);
		}
	}
	
	//let Sphinx build match excerpts
	function _buildExcerpts($comments, $index) {
		return $this->cl->BuildExcerpts ($comments, $index, $this->searchwords, array(
				'before_match' => '<span class="match">',
				'after_match' => '</span>',
				'chunk_separator' => '...',
				'limit' => 256,
				'around' => 5,
			));
	}
}
?>
