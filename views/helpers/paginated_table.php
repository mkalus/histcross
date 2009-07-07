<?php
/*********************************************************
 * histcross v2.0
 * File: paginated_table.php
 * Created: 24.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 * 
 * Taken from Bakery of cakephp with header.
 * Other methods are of my own devise.
 *********************************************************/

//Add Access-Keeper
if (!class_exists('AccessKeeper')) App::import('Vendor', 'access_keeper');
if (!class_exists('Sanitize')) App::import('Sanitize');

class PaginatedTableHelper extends AppHelper {
	var $helpers = array('Html', 'Paginator', 'Auth', 'Ajax', 'HcSupport');
	
	//i18n-Helper variables to speed up things
	var $details, $edit;

	/**
	 * initialize some stuff
	 */
	function init() {
		$this->details = __('Details', true);
		$this->edit = __('Edit', true);
	}

	/**
	 * Create a paginated table
	 * $title = Title of Data
	 * $data = Data itself
	 * $headers = array($sortfield => $title
	 * 			'1' => 'TitleNotLinked') //numeric keys are not linked
	 * $formats = array(
	 * 		array(
	 * 			'model' => 'Bibliography',
	 * 			'field' => 'id',
	 * 		),
	 * 		...
	 * )
	 */
	function createTable($title, $controller, $data, $headers, $formats, $icon = null, $ajax = false, $uniqadd = '') {
		$this->init();
		
		//einzigartiges Handle
		$handle = Inflector::tableize($controller).$uniqadd;
		//other paginator - model?
		$additions = array('url' => array('handle' => $handle));
		if ($uniqadd != '')
			$additions['model'] = Inflector::singularize($controller).$uniqadd;

		//activate ajax?
		if ($ajax) {
			$options = array(
				'url'	=> array('handle' => $handle),
				'indicator' => $handle.'loading',
				'update'	=> $handle.'paging'
			);
			$this->Paginator->options($options);
		}
		
		//first create a div
		echo '<div class="'.$controller.' index" id="'.$handle.'paging">';
		//Head
		echo '<h2>';
    	//Add New-Icon?
    	if ($this->Auth->sessionValid()) {
    		//Check Access
    		if (AccessKeeper::checkAccess($controller, 'add', $this->Auth->user('group'))) {
    			echo $this->Html->link(
    				$this->Html->image(
						'icons'.DS.__('icon_new_en.gif', true),
						array('width' => '32', 'height' => '16')
					),
					array(
						'controller'=>Inflector::tableize($controller),
						'action'=>'add'
					),
					array('title' => __('New', true)),
					false,
					false
				).' ';
    		}
    	}
		echo __($title, true).'</h2>';
		//Paginator
		echo '<p>'.$this->Paginator->counter(am(array(
			'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
			), $additions)).'</p>';
		//Table definition
		echo '<table class="listtable">';
		//Header
		$this->_createTableHeader($headers);
		//Create Table cells
		$this->_createTableCells($data, $formats, $icon);
		//Close tags
		echo '</table>';
		//Create Paging bottom
		echo '<div class="paging">';
		//loading indicator
		echo '<div id="'.$handle.'loading" style="display:none; float: right;">';
		echo $this->Html->image('ajax-loader.gif');
		echo '</div>';

		//Correct sort keys in some cases
		if (key_exists('sort', $this->params['named'])) {
			$additions['url']['sort'] = $this->params['named']['sort'];
			$additions['url']['direction'] = $this->params['named']['direction'];
		}

		echo $this->Paginator->prev('« '.__('previous', true), am(array('escape' => false, 'class'=>'enabled'), $additions), null, array('class'=>'disabled'));
		echo ' '.$this->Paginator->numbers(am(array('separator' => ' '), $additions)).' ';
		echo $this->Paginator->next(__('next', true).' »', am(array('escape' => false, 'class'=>'enabled'), $additions), null, array('class'=>'disabled'));
		echo '</div>';
		echo '</div>';
	}
	
	/**
	 * expects $headers to be an associative array of $sortfield => $title
	 */
	function _createTableHeader($headers) {
		echo '<tr><th></th>';
		foreach($headers as $key => $val)
			if (is_numeric($key)) //numeric keys are no links, simple, eh?
				echo $this->nolinkheader(__($val, true));
			else echo $this->linkheader($key, __($val, true));
		echo '</tr>';
		
	}

	/**
	 * Creates table cells with data taken from createTable-Fucntion
	 */
	function _createTableCells($data, $formats, $icon) {
		$row = 0;
		foreach ($data as $entry) {
			//set class of row
			$class = null;
			if ($row++ % 2 == 0) $class = ' class="altrow"';
			echo '<tr'.$class.'>';
			//Traverse through entries
			for ($i = 0; $i < count($formats); $i++) {
				$tdclass = null;
				if (key_exists('class', $formats[$i]) && $formats[$i]['class'] != '') $tdclass = ' class="'.$formats[$i]['class'].'"';
				$value = $entry[$formats[$i]['model']][$formats[$i]['field']];
				//Sanitize value
				$value = Sanitize::html($value);
				//Format-Methode
				if (key_exists('format', $formats[$i]) && $formats[$i]['format'] != '')
					$value = $this->$formats[$i]['format']($value, $icon, $formats[$i], $entry);
				echo '<td'.$tdclass.'>'.$value.'</td>';
			}
			echo '</tr>';
		}
	}

    function linkheader($field, $name = null, $options = array()) {
        $sort = ($this->Paginator->sortKey() == $field ? $this->Paginator->sortDir() : 'undefined');
        $name = (!isset($name) ? Inflector::humanize($field) : $name);
        
        return '<th class="'.$sort.'">'.$this->Paginator->sort($name, $field, $options).'</th>';
        
/*        return $this->Html->tag('th', 
            $this->Paginator->sort($name, $field, $options), 
            array('class' => $sort)
        );*/
    }
    
    function nolinkheader($field) {
        return '<th>'.$field.'</th>';
    }
    
    /**
     * Format of an Icon & Edit Value
     */
    function iconandedit($value, $icon, $format, $row) {
   		$value = '<a href="/'.(Inflector::tableize(isset($format['refmodelname'])?$format['refmodelname']:$format['refmodel'])).'/view/'.low($row[$format['refmodel']][$format['reffield']]).'" title="'.$this->details.'"><img src="/img/icons/'.$icon.'" width="16" height="16" /></a>';
/*    	$value = $this->Html->link(
 	  		$this->Html->image(
				'icons'.DS.$icon,
				array('width' => '16', 'height' => '16')
			),
			array(
				'controller' => Inflector::tableize(isset($format['refmodelname'])?$format['refmodelname']:$format['refmodel']),
				'action'=>'view',
				low($row[$format['refmodel']][$format['reffield']])
			),
    		array('title' => __('Details', true)),
    		false,
    		false
    	);*/
    	//Add Edit-Icon?
    	if ($this->Auth->sessionValid()) {
    		//Check Access
    		if (AccessKeeper::checkAccess(Inflector::pluralize(isset($format['refmodelname'])?$format['refmodelname']:$format['refmodel']), 'edit', $this->Auth->user('group'))) {
		   		$value .= ' <a href="/'.(Inflector::tableize(isset($format['refmodelname'])?$format['refmodelname']:$format['refmodel'])).'/edit/'.low($row[$format['refmodel']][$format['reffield']]).'" title="'.$this->edit.'"><img src="/img/icons/icon_editsmall.gif" width="16" height="16" /></a>';
/*    			$value .= ' '.$this->Html->link(
    				$this->Html->image(
						'icons'.DS.'icon_editsmall.gif',
						array('width' => '16', 'height' => '16')
					),
					array(
						'controller' => Inflector::tableize(isset($format['refmodelname'])?$format['refmodelname']:$format['refmodel']),
						'action'=>'edit',
						$row[$format['refmodel']][$format['reffield']]
					),
					array('title' => __('Edit', true)),
					false,
					false
				);*/
    		}
    	}
    	return $value;
    }

    /**
     * Wrap value in Link
     */
    function link($value, $icon, $format, $row) {
    	return '<a href="/'.(Inflector::tableize(isset($format['refmodelname'])?$format['refmodelname']:$format['refmodel'])).'/view/'.$row[$format['refmodel']][$format['reffield']].'" title="'.$this->details.'">'.$value.'</a>';
/*    	return $this->Html->link(
    		$value,
			array(
				'controller' => Inflector::tableize(isset($format['refmodelname'])?$format['refmodelname']:$format['refmodel']),
				'action' => 'view',
				$row[$format['refmodel']][$format['reffield']]
			),
    		array('title' => __('Details', true)),
    		false,
    		false
    	);*/
    }

	/**
	 * Wrap value in Link and put Icon in front
	 */
    function iconandlink($value, $icon, $format, $row) {
    	return $this->iconsmall($row[$format['refmodel']]['pictogram_id']).
    		' '.$this->link($value, $icon, $format, $row);
    }

	/**
	 * Change Password icon and link
	 */
    function changepassword($value, $icon, $format, $row) {
    	return $this->Html->link(
    		$this->Html->image(
				'icons'.DS.'icon_password.png',
				array('width' => 16, 'height' => 16, 'alt' => __('Change Password', true))
			),
			array(
				'controller' => 'users',
				'action' => 'changepassword',
				$row[$format['refmodel']][$format['reffield']]
			),
    		array('title' => __('Change Password', true)),
    		false,
    		false
    	);
    }

	/**
	 * Return big Icon from value
	 */
    function iconbig($value, $icon = null, $format = null, $row = null) {
    		return $this->HcSupport->getIconHTML($value, true);
    }

	/**
	 * Return big Icon from value
	 */
    function iconsmall($value, $icon = null, $format = null, $row = null) {
    		return $this->HcSupport->getIconHTML($value, false);
    }

	/**
	 * Convert numeric date in hc-format using HcSupport->dateformat
	 */
    function timeentry($value, $icon, $format, $row) {
    	$val = $this->HcSupport->dateformat(
    		$row[$format['refmodel']][$format['reffield'].'_entry'],
    		$row[$format['refmodel']][$format['reffield'].'_ca'],
    		$row[$format['refmodel']][$format['reffield'].'_questionable'],
    		$row[$format['refmodel']][$format['reffield'].'_julian'],
    		$row[$format['refmodel']][$format['reffield']]
    	);
    	return ($val != ''?$val:'-----');
    }
}
?>