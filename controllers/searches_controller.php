<?php
/*********************************************************
 * histcross v2.0
 * File: searches_controller.php
 * Created: 11.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//Add Access-Keeper
if (!class_exists('SearchEngineFactory')) App::import('Vendor', 'search_engine_factory');

class SearchesController extends AppController {
	var $name = 'Searches';
	var $searchEngine = null;
	
	function search() {
		//transform paginated stuff
		if (key_exists('s', $this->params['named']))
			$this->params['url']['s'] = $this->params['named']['s'];
		if (key_exists('page', $this->params['named']))
			$this->params['url']['page'] = $this->params['named']['page'];


		//check if there was a search word
		if (!isset($this->params['url']['s']) || $this->params['url']['s'] == '') {
			$this->Session->setFlash(__('Please submit a search phrase!', true));
			$this->redirect($this->referer());
		}
		
		//get search engine instance
		$this->initiateSearchEngine();
		
		//pagination
		if (isset($this->params['url']['page'])) $page = $this->params['url']['page'];
		else $page = null;
		
		//now let the search engine look for stuff
		$this->searchEngine->search($this->params['url']['s'], $page);
		
		//set the variables
		$hits = $this->searchEngine->numberOfHits();
		$pages = $this->searchEngine->numberOfPages();
		$current = $this->searchEngine->currentPage();
		
		//set the variables for the view
		$this->set('search', $this->params['url']['s']);
		$this->set('hits', $hits);
		$this->set('pages', $pages);
		$this->set('current', $current);
		$this->set('matches', $this->searchEngine->getResults());
		$this->set('backlink', $this->referer());
		$this->set('highlighttype', $this->searchEngine->getHighlightype());

		//tweak the paginator...
		$this->params['paging']['Search']['pageCount'] = $pages;
		$this->params['paging']['Search']['count'] = $hits;
		$this->params['paging']['Search']['page'] = $current;
		$this->params['paging']['Search']['options']['limit'] = PERPAGE;
		$this->params['paging']['Search']['defaults']['limit'] = PERPAGE;
		$this->params['paging']['Search']['prevPage'] = ($current != 1?true:false);
		$this->params['paging']['Search']['nextPage'] = ($current != $pages?true:false);
	}
	
	/**
	 * get search engine instance
	 */
	function initiateSearchEngine() {
		$this->searchEngine = SearchEngineFactory::createSearchEngine($this);
	}
}
?>