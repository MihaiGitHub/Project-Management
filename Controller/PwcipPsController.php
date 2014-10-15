<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('String', 'Utility');
App::uses('CakeNumber', 'Utility');

class PwcipPsController extends AppController {
	public $name = 'PwcipPs';
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Paginator', 'FileUploader');
	public $uses = array('PwcipP', 'PwcipPicturesP', 'PwcipAttachmentsP', 'PwcipStatusP');	
	
    public function admin_index(){
	
		$this->paginate = array(
					'conditions' => array('PwcipP.ProjectDeleted' => 0),
					'paramType' => 'querystring',
					'order' => 'PwcipP.CIPNumber ASC',
					'limit' => 15
				);
				
		$projects = $this->paginate('PwcipP');
		$this->set(compact('projects'));
		
		$this->set('projects', $projects);
		$this->set('title', 'Downtown Projects | Official Website of the City of Tucson');
    }
	
	public function beforeFilter() {
        parent::beforeFilter();
		if($this->Auth->user('role') == 'admin'){ 
			$this->Auth->allow();
		} else {
			$this->Auth->logout();
		}
    }
	
	public function admin_add(){
		if($this->request->is('post')) {	
			
			$this->request->data['PwcipP']['Description'] = str_replace("<br><br>", "<p>", str_replace("\n", "<br>", $this->request->data['PwcipP']['Description']) );
			$this->request->data['PwcipP']['AdditionalInfo'] = str_replace("<br><br>", "<p>", str_replace("\n", "<br>", $this->request->data['PwcipP']['AdditionalInfo']) );

			if($this->PwcipP->save($this->request->data)) 
				return $this->redirect(array('action' => 'index')); 
				
		}
		$this->set('title', 'Downtown Projects | Official Website of the City of Tucson');
	}
	
	public function admin_view($cipid = null){
		if (!$cipid) {
            throw new NotFoundException(__('Invalid Project'));
        }

        $project = $this->PwcipP->findByCipid($cipid);
        if (!$project) {
            throw new NotFoundException(__('Invalid Project'));
        }
				
		$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));
		$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));
		$attachmentscount = $this->PwcipAttachmentsP->find('count', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid)));
		
		$attachedbudget = ($project['PwcipP']['AttachedBudget'] == '') ? 'no' : 'yes';
		$attachedpic = ($project['PwcipP']['ProjectPicture'] == '') ? 'no' : 'yes';
	
		$this->set('updatescount', $updatescount);
		$this->set('picturescount', $picturescount);
		$this->set('attachmentscount', $attachmentscount);
		$this->set('attachedbudget', $attachedbudget);
		$this->set('attachedpic', $attachedpic);

        $this->set('project', $project);	
		$this->set('cipid', $cipid);
		$this->set('title', $project['PwcipP']['CIPName'].' | Official Website of the City of Tucson');
	}
	
	public function admin_edit($cipid = null) {
		if (!$cipid) {
			throw new NotFoundException(__('Invalid Project'));
		}

        $project = $this->PwcipP->findByCipid($cipid);
		 	
		$project['PwcipP']['Description'] = str_replace("<br>", "\n", str_replace("<p>", "\n\n", $project['PwcipP']['Description']));
		$project['PwcipP']['AdditionalInfo'] = str_replace("<br>", "\n", str_replace("<p>", "\n\n", $project['PwcipP']['AdditionalInfo']));
       
        if (!$project) {
            throw new NotFoundException(__('Invalid Project'));
        }

		if ($this->request->is('post') || $this->request->is('put')) { 

			if(isset($this->data['delete']) && $this->data['delete'] == 'delete'){
				$this->PwcipP->updateAll(array('ProjectDeleted' => 1), array('CIPID' => $cipid));
			} else {
				
				$this->request->data['PwcipP']['Description'] = str_replace("<br><br>", "<p>", str_replace("\n", "<br>", $this->request->data['PwcipP']['Description']) );
				$this->request->data['PwcipP']['AdditionalInfo'] = str_replace("<br><br>", "<p>", str_replace("\n", "<br>", $this->request->data['PwcipP']['AdditionalInfo']) );
				$this->PwcipP->save($this->request->data);
				
			}
			if($this->PwcipP->updateAll(array('ProjectUpdated' => 1), array('CIPID' => $cipid))) 
				return $this->redirect(array('action' => 'view/'.$cipid));		
		}

		if (!$this->request->data) {
			$this->request->data = $project;
		}
		
		$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));

		$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));
	
		$attachmentscount = $this->PwcipAttachmentsP->find('count', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid)));

		
		$attachedbudget = ($project['PwcipP']['AttachedBudget'] == '') ? 'no' : 'yes';
		$attachedpic = ($project['PwcipP']['ProjectPicture'] == '') ? 'no' : 'yes';
	
		$this->set('updatescount', $updatescount);
		$this->set('picturescount', $picturescount);
		$this->set('attachmentscount', $attachmentscount);
		$this->set('attachedbudget', $attachedbudget);
		$this->set('attachedpic', $attachedpic);

		$this->set('project', $project);
		$this->set('cipid', $cipid);
		$this->set('title', $project['PwcipP']['CIPName'].' | Official Website of the City of Tucson');
	}
	
	public function admin_budget($cipid = null){
		if (!$cipid) {
			throw new NotFoundException(__('Invalid ID'));
		}
				
		$project = $this->PwcipP->findByCipid($cipid);
		$action = ($project['PwcipP']['AttachedBudget'] == '') ? 'ADD' : 'EDIT';
		
		if ($this->request->is('post') || $this->request->is('put')) { 
			
			if($this->data['PwcipP']['action'] == 'EDIT'){
			if($this->data['PwcipP']['Delete'] == 'NO'){	
				
				if(!empty($this->request->data['PwcipP']['BudgetFile']['name'])){
					$attachID = String::uuid();
					
					$output = array();
					
					$filename = $this->request->data['PwcipP']['BudgetFile']['name'];
					$extension = pathinfo($filename, PATHINFO_EXTENSION);
					
					if($extension == 'pdf'){		
						$this->request->data['PwcipP']['AttachedBudget'] = $attachID.'.'.$extension;
						$this->request->data['PwcipP']['BudgetFile']['name'] = $this->request->data['PwcipP']['AttachedBudget'];		
				
						$data = Sanitize::clean($this->request->data);
						$file = $data['PwcipP']['BudgetFile'];
					
						$fileDestination = 'files/budget/';	 
					
						try{
							$output = $this->FileUploader->upload($file, $fileDestination);
						}catch(Exception $e){
							$output = array('bool' => FALSE, 'error_message' => $e->getMessage());
						}
						
						$budget = $this->request->data['PwcipP']['AttachedBudget'];
						if($this->PwcipP->updateAll(array('PwcipP.AttachedBudget' => "'$budget'", 'ProjectUpdated' => 1), array('CIPID' => $cipid)))
							return $this->redirect(array('action' => 'view/'.$cipid));
					} else {
						$this->set('error', true);
					}
				}					
			} else {					
				if($this->PwcipP->updateAll(array('AttachedBudget' => NULL, 'ProjectUpdated' => 1), array('CIPID' => $cipid)))
					return $this->redirect(array('action' => 'view/'.$cipid));				
			}
			} else {
			
				if(!empty($this->request->data['PwcipP']['BudgetFile']['name'])){
					$output = array();
					$attachID = String::uuid();
					
					$filename = $this->request->data['PwcipP']['BudgetFile']['name'];
					$extension = pathinfo($filename, PATHINFO_EXTENSION);
					
					if($extension == 'pdf'){
						$this->request->data['PwcipP']['AttachedBudget'] = $attachID.'.'.$extension;
						$this->request->data['PwcipP']['BudgetFile']['name'] = $this->request->data['PwcipP']['AttachedBudget'];		
				
						$data = Sanitize::clean($this->request->data);
						$file = $data['PwcipP']['BudgetFile'];
					
						$fileDestination = 'files/budget/';	 
					
						try{
							$output = $this->FileUploader->upload($file, $fileDestination);
						}catch(Exception $e){
							$output = array('bool' => FALSE, 'error_message' => $e->getMessage());
						}
						
						// must put value in quotes since the string is long and has dashes (it breaks otherwise(incorrect syntax near fa3..))
						$budget = $this->request->data['PwcipP']['AttachedBudget'];
						if($this->PwcipP->updateAll(array('AttachedBudget' => "'$budget'", 'ProjectUpdated' => 1), array('CIPID' => $cipid)))
							return $this->redirect(array('action' => 'view/'.$cipid));
					} else {
						$this->set('error', true);
					}
				}
			}
		}
			
		$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));
		$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));
		$attachmentscount = $this->PwcipAttachmentsP->find('count', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid)));

		$attachedbudget = ($project['PwcipP']['AttachedBudget'] == '') ? 'no' : 'yes';
		$attachedpic = ($project['PwcipP']['ProjectPicture'] == '') ? 'no' : 'yes';
	
		$this->set('updatescount', $updatescount);
		$this->set('picturescount', $picturescount);
		$this->set('attachmentscount', $attachmentscount);
		$this->set('attachedbudget', $attachedbudget);
		$this->set('attachedpic', $attachedpic);
		
		$this->set('cipid', $cipid);
		$this->set('project', $project);
		$this->set('action', $action);
		$this->set('title', $project['PwcipP']['CIPName'].' | Official Website of the City of Tucson');
	}
	
	public function admin_picture($cipid = null){
		if (!$cipid) {
			throw new NotFoundException(__('Invalid ID'));
		}
			
		$project = $this->PwcipP->findByCipid($cipid);
		$action = ($project['PwcipP']['ProjectPicture'] == '') ? 'ADD' : 'EDIT';
		
		if ($this->request->is('post') || $this->request->is('put')) { 
			$mimetype = array('bmp', 'gif', 'jpeg', 'png', 'jpg', 'JPG', 'BMP', 'GIF', 'JPEG', 'PNG');
			if($this->data['PwcipP']['action'] == 'EDIT'){
			if($this->data['PwcipP']['Delete'] == 'NO'){	
				
				if(!empty($this->request->data['PwcipP']['PictureFile']['name'])){
					$pictureID = String::uuid();
										
					$output = array();
					
					$filename = $this->request->data['PwcipP']['PictureFile']['name'];
					$extension = pathinfo($filename, PATHINFO_EXTENSION);
					
					if(in_array($extension, $mimetype)){
						$this->request->data['PwcipP']['ProjectPicture'] = $pictureID.'.'.$extension;
						$this->request->data['PwcipP']['PictureFile']['name'] = $this->request->data['PwcipP']['ProjectPicture'];		
				
						$data = Sanitize::clean($this->request->data);
						$file = $data['PwcipP']['PictureFile'];
					
						$fileDestination = 'pictures/';	 
					
						try{
							$output = $this->FileUploader->upload($file, $fileDestination);
						}catch(Exception $e){
							$output = array('bool' => FALSE, 'error_message' => $e->getMessage());
						}
						
						$picture = $this->request->data['PwcipP']['ProjectPicture'];
						if($this->PwcipP->updateAll(array('ProjectPicture' => "'$picture'", 'ProjectUpdated' => 1), array('CIPID' => $cipid)))
							return $this->redirect(array('action' => 'view/'.$cipid));

					} else {
						$this->set('error', true);
					}
				}						
			} else {					
				if($this->PwcipP->updateAll(array('ProjectPicture' => NULL, 'ProjectUpdated' => 1), array('CIPID' => $cipid)))
					return $this->redirect(array('action' => 'view/'.$cipid));
			}
			} else {
				if(!empty($this->request->data['PwcipP']['PictureFile']['name'])){
					$output = array();
					$pictureID = String::uuid();
					$filename = $this->request->data['PwcipP']['PictureFile']['name'];
					$extension = pathinfo($filename, PATHINFO_EXTENSION);
										
					if(in_array($extension, $mimetype)){
						$this->request->data['PwcipP']['ProjectPicture'] = $pictureID.'.'.$extension;
						$this->request->data['PwcipP']['PictureFile']['name'] = $this->request->data['PwcipP']['ProjectPicture'];		
				
						$data = Sanitize::clean($this->request->data);
						$file = $data['PwcipP']['PictureFile'];
					
						$fileDestination = 'pictures/';	 
					
						try{
							$output = $this->FileUploader->upload($file, $fileDestination);
						}catch(Exception $e){
							$output = array('bool' => FALSE, 'error_message' => $e->getMessage());
						}
						
						$picture = $this->request->data['PwcipP']['ProjectPicture'];
						if($this->PwcipP->updateAll(array('ProjectPicture' => "'$picture'", 'ProjectUpdated' => 1), array('CIPID' => $cipid)))
							return $this->redirect(array('action' => 'view/'.$cipid));
					} else {
						$this->set('error', true);
					}
				}
			}
		}
			
		$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));
		$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));
		$attachmentscount = $this->PwcipAttachmentsP->find('count', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid)));
		
		$attachedbudget = ($project['PwcipP']['AttachedBudget'] == '') ? 'no' : 'yes';
		$attachedpic = ($project['PwcipP']['ProjectPicture'] == '') ? 'no' : 'yes';
	
		$this->set('updatescount', $updatescount);
		$this->set('picturescount', $picturescount);
		$this->set('attachmentscount', $attachmentscount);
		$this->set('attachedbudget', $attachedbudget);
		$this->set('attachedpic', $attachedpic);
		$this->set('cipid', $cipid);
		$this->set('project', $project);
		$this->set('action', $action);
		$this->set('title', $project['PwcipP']['CIPName'].' | Official Website of the City of Tucson');
	}
}