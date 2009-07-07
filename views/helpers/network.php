<?php
/*********************************************************
 * histcross v2.0
 * File: network.php
 * Created: 16.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

App::import('Core', 'File');

class NetworkHelper extends Helper {
	var $helpers = array('Html');
	var $model = null, $id = null, $vertices = null, $edges = null;
	var $file, $image;
	var $type;		//Type of graphic to create (def = png)
	var $width;		//x-size
	var $height;		//y-size
	var $dotSpec;		//Dot-Specification after BuildGraph
	var $rand;		//deterministic or random graph layout?

	function prepareData($model, $id, &$vertices, &$edges) {
		//overwrite old data
		$this->model = $model;
		$this->id = $id;
		$this->vertices = $vertices;
		$this->edges = $edges;
		
		//clean other data
		$this->file = null;
		$this->image = null;
		$this->dotSpec = null;
		
		//general default values
		$this->type = 'png';
		$this->width = 700;
		$this->height = 600;
		$this->rand = 'rand'; //random layouts
	}

	function buildFile() {
		//first build graph
		$this->_createGraph();
		//save it to a file
		return $this->_createGraphVizFile();
	}
	
	function _createGraph() {
		$this->dotSpec = 'digraph G { graph [overlap=false,mode=ipsep,sep=1.0,fontname = "Helvetica-Oblique"];'."\n";
		
		//Add nodes:
		$url = 'http://'.env('HTTP_HOST').'/vertices/view/';
		foreach($this->vertices as $key => $val) {
			$this->dotSpec .= ' '.$key.' [shape=box,fontsize = 14.0,label="'.Sanitize::html($val).'",URL="'.$url.$key.'"];'."\n";
		}

		//Add relations:
		foreach($this->edges as $val) {
			$this->dotSpec .= ' '.$val['Relation']['from_vertex_id'].' -> '.$val['Relation']['to_vertex_id'].' [fontsize=10.0,label="'.$val['RelationType']['title_from'].'"];'."\n";
		}

		$this->dotSpec .= '}';
	}

	/**
	 * save file as gv file
	 */
	function _createGraphVizFile() {
		$this->file = 'files/networks/'.Inflector::tableize($this->model).'_'.$this->id.'.gv';
		$file =& new File(WWW_ROOT.$this->file, true, 0755);
		$file->write($this->dotSpec, 'w');
		$file->close();

		return $this->file;
	}

	/**
	 * creates a nice output..-
	 */
	function createNetwork($filetype = null) {
		if ($filetype == null) $filetype = $this->type;
		
		//creates graphviz file
		$tempfile = $this->createVisualFile();
		//filename for converted file - relative to WWW_DATA/img
		$outputfile = 'networks/'.Inflector::tableize($this->model).'_'.$this->id;
		$big = $outputfile.'.'.$filetype;
		$small = $outputfile.'_small.'.$filetype;
		
		//convert using imagemagick
		echo exec(Configure::read('HC.convert_path').' "'.WWW_ROOT.$tempfile.'" "'.WWW_ROOT.'img/'.$big.'"');
		echo exec(Configure::read('HC.convert_path').' -resize '.$this->width.'x'.$this->height.' "'.WWW_ROOT.'img/'.$big.'" "'.WWW_ROOT.'img/'.$small.'"');
		
		return array('small' => $small, 'big' => $big);
	}

	/**
	 * runs graphviz to create graph
	 */
	function createVisualFile($filetype = null) {
		if ($filetype == null) $filetype = 'ps';
		
		$outputfile = 'files/networks/'.Inflector::tableize($this->model).'_'.$this->id.'.'.$filetype;
		$exec = Configure::read('HC.graphviz_path').' -T'.$filetype.' -Gstart='.$this->rand.' -o '.WWW_ROOT.$outputfile.' '.WWW_ROOT.$this->file;
		echo exec($exec);
		
		return $outputfile;
	}
}
?>