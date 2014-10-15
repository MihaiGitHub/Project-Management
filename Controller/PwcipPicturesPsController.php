<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('String', 'Utility');
App::uses('File', 'Utility');

class PwcipPicturesPsController extends AppController {
	public $name = 'PwcipPicturesPs';
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('ImageUploader');
	public $uses = array('PwcipP', 'PwcipPicturesP', 'PwcipAttachmentsP', 'PwcipStatusP');
	
	public function admin_index($cipid = null){
	
		if (!$cipid) {
			throw new NotFoundException(__('Invalid Project'));
		}
		$project = $this->PwcipP->find('first',array('conditions' => array('PwcipP.CIPID' => $cipid), 
			'fields' => array('PwcipP.CIPName AS Name')));

		$pictures = $this->PwcipPicturesP->find('all', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid),
															 'order' => array('PwcipPicturesP.Date DESC')));
		$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));
		$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));
		$attachmentscount = $this->PwcipAttachmentsP->find('count', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid)));
				
		$attachedbudget = ($pictures[0]['PwcipP']['AttachedBudget'] == '') ? 'no' : 'yes';
		$attachedpic = ($pictures[0]['PwcipP']['ProjectPicture'] == '') ? 'no' : 'yes';
	
		$this->set('updatescount', $updatescount);
		$this->set('picturescount', $picturescount);
		$this->set('attachmentscount', $attachmentscount);
		$this->set('attachedbudget', $attachedbudget);
		$this->set('attachedpic', $attachedpic);

		$this->set('pictures', $pictures);
		$this->set('cipid', $cipid);	
		$this->set('title', $project[0]['Name'].' |  Official Website of the City of Tucson');
	}
	
	public function beforeFilter() {
        parent::beforeFilter();
		if($this->Auth->user('role') == 'admin'){ 
			$this->Auth->allow();
		} else {
			$this->Auth->logout();
		}  
    }
	
	public function admin_add($cipid = null){
		if (!$cipid) {
			throw new NotFoundException(__('Invalid Project'));
		}
		
		if($this->request->is('post')){
			$output= array();  
			$data = Sanitize::clean($this->request->data);
			$file = $data['file']['image'];
			$fileDestination = 'pictures/';	 
	 
		    try{
				$output = $this->ImageUploader->upload($file, $fileDestination);
		    }catch(Exception $e){
				$output = array('bool' => FALSE, 'error_message' => $e->getMessage());
		    }
			
			if ($this->PwcipPicturesP->save($this->request->data)) { 
				if($this->PwcipP->updateAll(array('ProjectUpdated' => 1), array('CIPID' => $cipid)))
						return $this->redirect('index/'.$cipid);
			}
		} else {
			$pictureID = String::uuid();
			
			$project = $this->PwcipP->find('first',array('conditions' => array('PwcipP.CIPID' => $cipid), 
			'fields' => array('PwcipP.CIPName AS Name', 'PwcipP.AttachedBudget AS Budget', 'PwcipP.ProjectPicture AS Picture')));		
			$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));
			$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));

			$attachmentscount = $this->PwcipAttachmentsP->find('count', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid)));
					
			$attachedbudget = ($project[0]['Budget'] == '') ? 'no' : 'yes';
			$attachedpic = ($project[0]['Picture'] == '') ? 'no' : 'yes';
		
			$this->set('updatescount', $updatescount);
			$this->set('picturescount', $picturescount);
			$this->set('attachmentscount', $attachmentscount);
			$this->set('attachedbudget', $attachedbudget);
			$this->set('attachedpic', $attachedpic);
		
			$this->set('name', $project[0]['Name']);
			$this->set('cipid', $cipid);
			$this->set('pictureid', $pictureID);
			$this->set('title', $project[0]['Name'].' |  Official Website of the City of Tucson');
		}
	}
	
	public function admin_edit($pictureid = null){
		if (!$pictureid) {
			throw new NotFoundException(__('Invalid Picture ID'));
		}
			
		$picture = $this->PwcipPicturesP->findByPicturesid($pictureid);
		
        if (!$picture) {
            throw new NotFoundException(__('Invalid Picture'));
        }
		
		$cipid = $picture['PwcipPicturesP']['CIPID'];
		
		$project = $this->PwcipPicturesP->find('first',array('conditions' => array('PwcipP.CIPID' => $cipid), 
			'fields' => array('PwcipP.CIPName AS Name', 'PwcipP.AttachedBudget AS Budget', 'PwcipP.ProjectPicture AS Picture')));

		if ($this->request->is('post') || $this->request->is('put')) { 
					
			if($this->data['PwcipPicturesP']['Delete'] == 'NO'){	
			
				$output = array();  
				$data = Sanitize::clean($this->request->data);
				$file = $data['file']['image'];
				if(!empty($file['name'])){
					
					$fileDestination = 'pictures/';	 
		 
					try{
						$output = $this->ImageUploader->upload($file, $fileDestination);
					}catch(Exception $e){
						$output = array('bool' => FALSE, 'error_message' => $e->getMessage());
					}
				}
				
				$this->PwcipPicturesP->Picturesid = $pictureid;
				$this->PwcipPicturesP->save($this->request->data);
			} else {	
				if($this->PwcipPicturesP->delete($this->data['PwcipPicturesP']['PicturesID'])){
				//	$file = new File(WWW_ROOT . 'pictures/'.$picture['PwcipPicturesP']['Picture'], false, 0777);
				//	$file->delete();
				}
			}

			if($this->PwcipP->updateAll(array('ProjectUpdated' => 1), array('CIPID' => $cipid)))
				return $this->redirect('index/'.$cipid);
				
		} 
			

		if (!$this->request->data) {
			$this->request->data = $picture;
		}
		$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));	
		$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));

		
		$attachmentscount = $this->PwcipAttachmentsP->find('count', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid)));
				
		$attachedbudget = ($project[0]['Budget'] == '') ? 'no' : 'yes';
		$attachedpic = ($project[0]['Picture'] == '') ? 'no' : 'yes';
	
		$this->set('updatescount', $updatescount);
		$this->set('picturescount', $picturescount);
		$this->set('attachmentscount', $attachmentscount);
		$this->set('attachedbudget', $attachedbudget);
		$this->set('attachedpic', $attachedpic);

		$this->set('name', $project[0]['Name']);
		$this->set('cipid', $cipid);
		$this->set('picture', $picture);
		$this->set('title', $project[0]['Name'].' |  Official Website of the City of Tucson');
	}
}