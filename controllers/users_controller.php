<?php
/*********************************************************
 * histcross v2.0
 * File: users_controller.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
	var $paginate = array(
		'contain' => false,
		'limit' => PERPAGE,
		'order' => array(
			'User.name' => 'asc'
		),
		'conditions' => 'User.deleted = 0'
	);

	function index() {
		$this->User->contain();
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->User->contain();
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action'=>'index'));
		}
		if (($this->Auth->user('group') != 'admin' && $id != $this->Auth->user('id')) ||
			($this->Auth->user('group') != 'admin' && isset($this->data['User']['group']))) {
			$this->Session->setFlash(__('Privilege break', true));
			$this->redirect(array('action'=>'view', $this->Auth->user('id')));
		}
		if (!empty($this->data)) {
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action'=>'view', $this->data['User']['id']));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->User->contain();
			$this->data = $this->User->read(null, $id);
		}
	}
	
	function changepassword($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Auth->user('group') != 'admin' && $id != $this->Auth->user('id')) {
			$this->Session->setFlash(__('Privilege break', true));
			$this->redirect(array('action'=>'view', $this->Auth->user('id')));
		}
		if (!empty($this->data)) {
			$this->_handleCreatorChanger(); //add creator/changer to data
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The password has been changed', true));
				$this->redirect(array('action'=>'view', $this->data['User']['id']));
			} else {
				$this->Session->setFlash(__('The password could not be changed. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->User->contain();
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->User->saveField('deleted', 1);
		$this->Session->setFlash(__('User deleted', true));
		$this->redirect(array('action'=>'index'));
	}
	
	/**
	 * Login - handled by auth
	 */
	function login() {
		if ($this->Session->check('login_redirect'))
			$this->set('referer', $this->Session->read('login_redirect'));
		elseif ($this->referer() != '')
			$this->set('referer', $this->referer());
		else $this->set('referer', '/');
		
		if ($this->Session->check('login_name'))
			//$this->set('username', $this->Session->read('login_name'));
			$this->data['User']['username'] = $this->Session->read('login_name');
		
		$this->Session->delete('login_name');
		$this->Session->delete('login_redirect');
	}
	
	/**
	 * Real login - handled by me
	 */
	function user_login() {
		$error = false;
		
		if (!empty($this->data)) {
			$cleartext = true;
			$sucess = false;
			
			$salt = $this->Session->read('challenge');
			$someone = $this->User->findByUsername($this->params['data']['User']['username']);
			
			if(is_array($someone)) {
				//validate user
				if ($someone['User']['deleted'] == 1) {
					$this->Session->setFlash(__('This user has been deleted.', true));
					$this->redirect(array('controller' => 'users', 'action' => 'login'));
					return false;
				}
				
				//with js - superchallenged password
				if(isset($this->data['User']['user_ident']) && $this->data['User']['user_ident']) {
					$cleartext = false;
				}
				//fallback if no js is set
				if($cleartext) {
					if($this->_encrypt($this->data['User']['password']) == $someone['User']['password'])
						$sucess = true;
				} else { //check superchallenged password
					//username+":"+password+":"+challenge as md5
					$encrypted = $this->_encrypt($this->data['User']['username'].':'.$someone['User']['password'].':'.$salt);
					//check, if passwords are the same
					if ($encrypted == $this->data['User']['user_ident'])
						$sucess = true;
				}
			}

			//logged in?
			if($sucess) {
				//update login time (without modify time change)
				$someone['User']['lastlogin'] = date('Y-m-d H:i:s');
				$this->User->save(array('User' => array('id' => $someone['User']['id'], 'lastlogin' => $someone['User']['lastlogin'], 'modified' => $someone['User']['modified'])));
				//actually log in user
				$this->Auth->login($someone['User']);
				//redirect
				$this->redirect($this->data['User']['referer']);
				return true;
			} else {
				$error = true;
				//new salt
				$salt = md5(uniqid(''));
				$this->set('challenge',$salt); 
				$this->Session->write('challenge', $salt);
			}
		} else { //user not found...
			$salt = md5(uniqid(''));
			$this->set('challenge',$salt); 
			$this->Session->write('challenge', $salt);
		}
		$this->set('error', $error);
		$this->Session->setFlash(__('Login failed. Invalid username or password.', true));
		$this->Session->write('login_name', $this->data['User']['username']);
		$this->Session->write('login_redirect', $this->data['User']['referer']);
		$this->redirect(array('controller' => 'users', 'action' => 'login'));
	}
	
	/**
	 * Encryption function
	 */
	function _encrypt($string) {
		return sha1($string);
	}

	/**
	 * Logout function
	 */
	function logout() {
		$this->Session->del('VertexList');
		$this->Session->setFlash(__('You have been logged out', true));
		$this->redirect($this->Auth->logout());
	}
	
	/**
	 * No viewing of index and view for unauthorized users
	 */
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('index');
		if (is_array($this->params['pass']) && key_exists(0, $this->params['pass']) &&
			$this->Auth->user('id') != $this->params['pass'][0])
			$this->Auth->deny('view', 'edit');
	}

	/**
	 * Sets the language
	 */
	function set_language($lang) {
			$this->Cookie->write('lang', $lang, false, '+365 day');
			$this->redirect($this->referer());
	}
}
?>