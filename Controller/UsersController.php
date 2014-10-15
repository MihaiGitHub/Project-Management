<?php
App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');

class UsersController extends AppController {
	public $name = 'Users';
	
	public function admin_index() {
		if($this->request->is('post')) {
			if ($this->Auth->login()) {			
				if($this->Auth->user('role') == 'admin')
					$this->redirect(array('controller' => 'PwcipPs', 'action' => 'index'));
				else
					$this->redirect($this->Auth->logout());
			} else {
				$this->set('error', 'Invalid username or password. Try again.');
			}			
		}
		$this->paginate = array(
					'paramType' => 'querystring',
					'order' => 'User.id ASC',
					'limit' => 15
				);
				
		$users = $this->paginate('User');
		$this->set(compact('users'));
		
		$this->set('users', $users);
    }
	
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('review_login', 'admin_login');
		if($this->Auth->user('role') == 'admin'){ 
			$this->Auth->allow();
		} else {
			$this->Auth->logout();
		}
		$this->set('username', $this->Auth->user('username'));
		$this->set('title', 'Downtown Projects | Official Website of the City of Tucson');
    }

    public function admin_adduser() { 
        if ($this->request->is('post')) { 
		
            $this->User->create();
			
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
			
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			
        }
    }
	
	public function admin_edituser($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid User'));
		}

        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid User'));
        }

		
		if ($this->request->is('post') || $this->request->is('put')) { 

			if(isset($this->data['delete']) && $this->data['delete'] == 'delete'){
				$this->User->delete($this->request->data['User']['id']);
				return $this->redirect(array('action' => 'index'));
			} else {
				if($this->request->data['User']['newpassword'] != $this->request->data['User']['password']){
					$this->set('error', 'Passwords do not match');
				} else {
					if($this->request->data['User']['initialpass'] == Security::hash($this->request->data['User']['oldpassword'], null, true)){
						if($this->User->save($this->request->data))
							return $this->redirect(array('action' => 'index'));
					} else {
						$this->set('error', 'Incorrect old password');
					}
				}	
			}		
		}

		$this->set('user', $user);
	}

	public function admin_login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {			
				if($this->Auth->user('role') == 'admin')
					$this->redirect(array('controller' => 'PwcipPs', 'action' => 'index'));
				else {
					$this->redirect($this->Auth->logout());
				}
			} else {
				$this->set('error', 'Invalid username or password. Try again.');
			}			
		}
	}
	
	public function admin_logout() {
		return $this->redirect($this->Auth->logout());
	}
	
	public function review_login() { 
		if ($this->request->is('post')) { 
			if ($this->Auth->login()) {			
				if($this->Auth->user('role') == 'admin' || $this->Auth->user('role') == 'standard'){ 
					$this->redirect(array('controller' => 'Projects', 'action' => 'index'));
				} else {
					if($this->Auth->logout())
						$this->redirect(array('controller' => 'Users', 'action' => 'review'));
				}
			} else {
				$this->set('error', 'Invalid username or password. Try again.');
			}
		}
	}
	
	public function review_logout(){
		$this->Auth->logout();
		$this->redirect(array('controller' => 'Users', 'action' => 'login'));
	}
}