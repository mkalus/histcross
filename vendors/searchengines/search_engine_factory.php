<?php
/*********************************************************
 * histcross v2.0
 * File: search_engine_factory.php
 * Created: 11.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class SearchEngineFactory {
	function createSearchEngine($controller, $name = null) {
		if ($name == null) $name = Configure::read('HC.SearchEngine');
		
		switch($name) {
			case 'sphinx': //create shpinx search
				App::import('Vendor', 'sphinx_search_engine');
				$searchEngine = new SphinxSearchEngineController();
				break;
			default: //simple search engine
				App::import('Vendor', 'simple_search_engine_controller');
				$searchEngine = new SimpleSearchEngineController();
				break;
		}
		
		$searchEngine->setController($controller);
		return $searchEngine;
	}
}
?>