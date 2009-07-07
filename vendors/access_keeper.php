<?php
/*********************************************************
 * histcross v2.0
 * File: access_keeper.php
 * Created: 24.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class AccessKeeper {
	function checkAccess($model, $action, $group) {
		$allowedActions = array(
			'Users' => array(
				'view' => array('admin'),
				'index' => array('admin'),
//				'index_all' => array('admin'),
				'add' => array('admin'),
				'edit' => array('admin', 'poweruser', 'user'),
				'delete' => array('admin'),
				'logout' => array('admin', 'poweruser', 'user'),
				'changepassword' => array('admin', 'poweruser', 'user')
			),
			'Vertices' => array(
				'index' => array('admin', 'poweruser', 'user'),
				'add' => array('admin', 'poweruser', 'user'),
				'edit' => array('admin', 'poweruser', 'user'),
				'delete' => array('admin', 'poweruser', 'user'),
				'edit_bibliography' => array('admin', 'poweruser', 'user'),
				'add_bibliography' => array('admin', 'poweruser', 'user'),
				'delete_bibliography' => array('admin', 'poweruser', 'user'),
				'ajax_autocomplete' => array('admin', 'poweruser', 'user'),
			),
			'Relations' => array(
				'index' => array('admin', 'poweruser', 'user'),
				'add' => array('admin', 'poweruser', 'user'),
				'edit' => array('admin', 'poweruser', 'user'),
				'delete' => array('admin', 'poweruser', 'user'),
				'edit_bibliography' => array('admin', 'poweruser', 'user'),
				'add_bibliography' => array('admin', 'poweruser', 'user'),
				'delete_bibliography' => array('admin', 'poweruser', 'user'),
				'possible_inferences' => array('admin', 'poweruser', 'user'),
				'add_inference' => array('admin', 'poweruser', 'user'),
			),
			'VertexClasses' => array(
				'index' => array('admin', 'poweruser'),
				'add' => array('admin', 'poweruser'),
				'edit' => array('admin', 'poweruser'),
				'delete' => array('admin', 'poweruser'),
			),
			'RelationClasses' => array(
				'index' => array('admin', 'poweruser'),
				'add' => array('admin', 'poweruser'),
				'edit' => array('admin', 'poweruser'),
				'delete' => array('admin', 'poweruser'),
			),
			'VertexTypes' => array(
				'index' => array('admin', 'poweruser'),
				'add' => array('admin', 'poweruser'),
				'edit' => array('admin', 'poweruser'),
				'delete' => array('admin', 'poweruser'),
			),
			'RelationTypes' => array(
				'index' => array('admin', 'poweruser'),
				'add' => array('admin', 'poweruser'),
				'edit' => array('admin', 'poweruser'),
				'delete' => array('admin', 'poweruser'),
			),
			'Tagsets' => array(
				'add_set' => array('admin', 'poweruser', 'user'),
				'delete_set' => array('admin', 'poweruser', 'user'),
				'index' => array('admin', 'poweruser', 'user'),
				'edit' => array('admin', 'poweruser', 'user'),
				'delete' => array('admin', 'poweruser', 'user'),
				'ajax_autocomplete' => array('admin', 'poweruser', 'user'),
			),
			'default' => array(
				'index' => array('admin', 'poweruser', 'user'),
				'add' => array('admin', 'poweruser', 'user'),
				'edit' => array('admin', 'poweruser', 'user'),
				'delete' => array('admin', 'poweruser', 'user'),
			),
		);

		if (isset($allowedActions[$model])) {
			$controllerActions = $allowedActions[$model];
			if (isset($controllerActions[$action]) &&
				in_array($group, $controllerActions[$action])) {
					return true;
				} else return false;
		}
		
		if (isset($allowedActions['default'][$action]) &&
			in_array($group, $allowedActions['default'][$action])) {
				return true;
			}
		
		return false;
	}
}
?>
