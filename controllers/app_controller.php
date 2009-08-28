<?php
/*********************************************************
 * histcross v2.0
 * File: app_controller.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//Add Access-Keeper
if (!class_exists('AccessKeeper')) App::import('Vendor', 'access_keeper');
//Sanitizer
if (!class_exists('Sanitize')) App::import('Sanitize');

class AppController extends Controller {
	var $components = array('Auth', 'RequestHandler', 'Cookie');
	var $helpers = array('Cache', 'Html', 'Form', 'Auth', 'Community', 'PaginatedTable', 'Ajax', 'Time', 'HcFormat');

	/**
	 * Before Filter callback
	 */
	function beforeFilter() {
		//Set Authentication System
	    $this->_initAuthHelper();
		$this->_setAuth();
		//Set global editor variable
		$GLOBALS['_USERID'] = $this->Auth->user('id');
		
		//localization
		App::import('Core', 'L10n');
		$this->L10n = new L10n();
		
		//read cookie
		$lang = $this->Cookie->read('lang');
		
		//set language
		if ($lang != '') {
			$this->L10n->get($lang);
			Configure::write('Config.language', $lang);
		} else
			$this->L10n->get();
		
		//Session challenge
		if (!$this->Session->check('challenge')) {
			$this->Session->write('challenge', md5(uniqid('')));
		}
		
		//Set authentification
		$this->Auth->authenticate = $this;
	}
	
	/**
	 * Checks whether a user is authorized to do a certain action or not
	 */
	function isAuthorized($action = null) {
		//pages are allowed from everywhere
		if ($this->name == 'Pages') return true;
		//action set?
		if (!$action) $action = $this->action;

		//ask Access Keeper, for access
		return AccessKeeper::checkAccess($this->name, $action, $this->Auth->user('group'));
	}
	
	/**
	 * protected funtion to set the general auth-component settings
	 */
	function _setAuth() {
		//Check if there is an Auth-Component present in the controller
		if (isset($this->Auth)) {
			//Authentification via controller
			$this->Auth->authorize = 'controller';
			//Set the login-Action
			$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
			//Logout to home
			$this->Auth->logoutRedirect = '/';
			//Only non-deleted Users are accepted
			$this->Auth->userScope = array('User.deleted' => 0);
			//Generally allow index and view pages and some other stuff
			$this->Auth->allow('index', 'view', 'search', 'viewglobe', 'aggregate_cloud',
				'viewnetwork', 'set_language', 'user_login', 'netxml', 'netplain');
			if ($this->name == 'Pages')
				$this->Auth->allow('display');
			$this->Auth->deny('edit', 'add', 'delete');
		}
	}
	
	/**
	 * Initialize AuthHelper
	 */
	function _initAuthHelper() {
		if (isset($this->Auth)) {
	 		$this->Auth->sessionKey = 'JundotalIzodOthacBen';
	 		$this->set('authSessionKey', $this->Auth->sessionKey);
		}
	}
	
	/**
	 * Handle the creator/changer fields before saving
	 */
	function _handleCreatorChanger() {
		//add changer to the data set
		$this->data[$this->modelClass]['changer_id'] = $this->Auth->user('id');
		//add creator to data set
		if (!isset($this->data[$this->modelClass]['id']))
			$this->data[$this->modelClass]['creator_id'] = $this->Auth->user('id');
	}

	/**
	 * Creates a bibliography without the elements already in the bibliography
	 */
	function _getBibliography(&$refmodel, $bibdata) {
		//Create a "no include"-list
		$noinclude = array();
		foreach($bibdata as $bibentry)
			$noinclude[] = $bibentry['id'];
		
		if (count($noinclude) == 0) //keine Einschränkungen
			return $refmodel->find('list', array(
				'fields'=> 'Bibliography.shorttitle',
				'order' => 'Bibliography.shorttitle',
			));
		return $refmodel->find('list', array(
			'fields'=>'Bibliography.shorttitle',
			'order' => 'Bibliography.shorttitle',
			'conditions' => array(
				'NOT' => array(
					'Bibliography.id' => $noinclude
				)
			)));
	}

	function edit_bibliography(&$refBibmodel) {
		$msg = '';
		if (!$this->RequestHandler->isAjax()) $msg = __('Error in Request - Ajax required!', true);
		else {
			$thisid = $this->params['pass']['0'];
			$bibentryid = $this->params['named']['bib'];
			$newvalue = chop($this->params['form']['value']);
			if (!is_numeric($thisid) || !is_numeric($bibentryid)) $msg = __('Error in Request - wrong parameters', true);
			else {
				$msg = chop($this->params['form']['value']);
				$refBibmodel->id = $bibentryid;
				$refBibmodel->saveField('pages', $newvalue);
				$sess = $this->Session->read($this->Auth->sessionKey);
				$refBibmodel->saveField('changer_id', $sess['id']);
			}
		}
		$this->set('msg', $msg);
	}

	function add_bibliography($model, &$mymodel, &$refmodel, &$refBibmodel) {
		$id = $this->params['pass'][0];
		if ($this->RequestHandler->isAjax()) {
			$bibid = $this->params['data']['bibliography_id'];
			$pages = $this->params['data']['pages'];
		} else {
			$bibid = $this->params['data'][$model]['bibliography_id'];
			$pages = $this->params['data'][$model]['pages'];
		}
		$err = null;
		
		if (!is_numeric($id) || !is_numeric($bibid)) $err = __('Error in Request - wrong parameters', true);
		
		$sess = $this->Session->read($this->Auth->sessionKey);
		
		if (!$err) {
			//prepare data
			$savedata = array('Bibliographies'.$model => array(
				low($model).'_id' => $id,
				'bibliography_id' => $bibid,
				'pages' => $pages,
				'creator_id' => $sess['id'],
				'changer_id' => $sess['id'],
			));
			//create new database entry
			$refBibmodel->save($savedata);
			//save entry in session to ease editing
			$this->Session->write('bib_id', $bibid);
			$this->Session->write('bib_pages', $pages);
		}

		//what page to show?
		if ($this->RequestHandler->isAjax()) {
			//Read data
			$mymodel->contain(array('Bibliography'));
			$data = $mymodel->read(null, $id);
			//Read Bibliography data
			$this->set('bibliography_list', $this->_getBibliography($refmodel, $data['Bibliography']));
			//Set variables and output view path
			$this->set('bibliographies', $data['Bibliography']);
			$this->set('id', $id);
			$this->set('model', $model);
			if ($err) $this->Session->setFlash($err, 'default', array(), 'bib');
			else $this->Session->setFlash(__('Bibliography added', true), 'default', array(), 'bib');
			$this->viewPath = 'elements';
			$this->render('view_bibliography_list');
		} else {
			if ($err) $this->Session->setFlash($err);
			else $this->Session->setFlash(__('Bibliography added', true));
			
			$this->redirect(array('controller' => Inflector::tableize($model), 'action' => 'view', $id));
		}
	}
	
	function delete_bibliography($model, &$mymodel, &$refmodel, &$refBibmodel) {
		$err = null;
		$id = $this->params['pass'][0];
		$bibentryid = $this->params['named']['bib'];
		if (!is_numeric($id) || !is_numeric($bibentryid)) $err = __('Error in Request - wrong parameters', true);

		if (!$err) {
			//delete entry
			$refBibmodel->del($bibentryid, false);
		}

		//what page to show?
		if ($this->RequestHandler->isAjax()) {
			//Read data
			$mymodel->contain(array('Bibliography'));
			$data = $mymodel->read(null, $id);
			//Read Bibliography data
			$this->set('bibliography_list', $this->_getBibliography($refmodel, $data['Bibliography']));
			//Set variables and output view path
			$this->set('bibliographies', $data['Bibliography']);
			$this->set('id', $id);
			$this->set('model', $model);
			if ($err) $this->Session->setFlash($err, 'default', array(), 'bib');
			else $this->Session->setFlash(__('Bibliography deleted', true), 'default', array(), 'bib');
			$this->viewPath = 'elements';
			$this->render('view_bibliography_list');
		} else {
			if ($err) $this->Session->setFlash($err);
			else $this->Session->setFlash(__('Bibliography deleted', true));
			
			$this->redirect(array('controller' => Inflector::tableize($model), 'action' => 'view', $id));
		}
	}
	
	function hashPasswords($data) {
		if (is_array($data) && key_exists('User', $data)) {
			if (key_exists('password', $data['User']) && $data['User']['password'] != '')
				$data['User']['password'] = sha1($data['User']['password']);
			if (key_exists('password2', $data['User']) && $data['User']['password2'] != '')
				$data['User']['password2'] = sha1($data['User']['password2']);
		}
		return $data;
	}
}
?>