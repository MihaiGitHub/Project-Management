<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('String', 'Utility');
App::uses('File', 'Utility');

class PwcipAttachmentsPsController extends AppController {
	public $name = 'PwcipAttachmentsPs';
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('FileUploader');		
	public $uses = array('PwcipP', 'PwcipPicturesP', 'PwcipAttachmentsP', 'PwcipStatusP');

	public function admin_index($cipid = null){
	
		if (!$cipid) {
			throw new NotFoundException(__('Invalid Project'));
		}
		
		$project = $this->PwcipP->find('first',array('conditions' => array('PwcipP.CIPID' => $cipid), 
			'fields' => array('PwcipP.CIPName AS Name')));

		$attachments = $this->PwcipAttachmentsP->find('all', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid),
																   'order' => array('PwcipAttachmentsP.Date DESC')));	
		$attachmentscount = $this->PwcipAttachmentsP->find('count', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid)));
		$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));
		$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));
				
		$attachedbudget = ($attachments[0]['PwcipP']['AttachedBudget'] == '') ? 'no' : 'yes';
		$attachedpic = ($attachments[0]['PwcipP']['ProjectPicture'] == '') ? 'no' : 'yes';
	
		$this->set('updatescount', $updatescount);
		$this->set('picturescount', $picturescount);
		$this->set('attachmentscount', $attachmentscount);
		$this->set('attachedbudget', $attachedbudget);
		$this->set('attachedpic', $attachedpic);

		$this->set('attachments', $attachments);
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
			
			$output = array();  
			
			if(!empty($this->request->data['PwcipAttachmentsP']['FileAttachment']['name'])){
				$fileid = String::uuid();
				$filename = $this->request->data['PwcipAttachmentsP']['FileAttachment']['name'];
				$this->request->data['PwcipAttachmentsP']['Attachment'] = $fileid.'_'.$filename;
				$this->request->data['PwcipAttachmentsP']['FileAttachment']['name']	= $this->request->data['PwcipAttachmentsP']['Attachment'];		
			}
			
			$data = Sanitize::clean($this->request->data);
			$file = $data['PwcipAttachmentsP']['FileAttachment'];			
			
			$fileDestination = 'files/';	 
			
			try{
				$output = $this->FileUploader->upload($file, $fileDestination);
		    }catch(Exception $e){
				$output = array('bool' => FALSE, 'error_message' => $e->getMessage());
		    }
	
			if ($this->PwcipAttachmentsP->save($this->request->data)) { 				
				if($this->PwcipP->updateAll(array('ProjectUpdated' => 1), array('CIPID' => $cipid)))
					return $this->redirect('index/'.$cipid);
			} 
			
			
		} else {
			$attachmentID = String::uuid();
			$project = $this->PwcipP->find('first',array('conditions' => array('PwcipP.CIPID' => $cipid), 
				'fields' => array('PwcipP.CIPName AS Name', 'PwcipP.AttachedBudget AS Budget', 'PwcipP.ProjectPicture AS Picture')));	
		
			$attachmentscount = $this->PwcipAttachmentsP->find('count', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid)));	
			$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));
			$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));
					
			$attachedbudget = ($project[0]['Budget'] == '') ? 'no' : 'yes';
			$attachedpic = ($project[0]['Picture'] == '') ? 'no' : 'yes';
		
			$this->set('updatescount', $updatescount);
			$this->set('picturescount', $picturescount);
			$this->set('attachmentscount', $attachmentscount);
			$this->set('attachedbudget', $attachedbudget);
			$this->set('attachedpic', $attachedpic);

			$this->set('name', $project[0]['Name']);
			$this->set('cipid', $cipid);
			$this->set('attachmentid', $attachmentID);
			$this->set('title', $project[0]['Name'].' |  Official Website of the City of Tucson');
		}
	}
	
	public function admin_edit($attachmentid = null){
		if (!$attachmentid) {
			throw new NotFoundException(__('Invalid Attachment ID'));
		}
			
		$attachment = $this->PwcipAttachmentsP->findByAttachmentsid($attachmentid);
		
        if (!$attachment) {
            throw new NotFoundException(__('Invalid Attachment'));
        }
		
		$cipid = $attachment['PwcipAttachmentsP']['CIPID'];
		
		$project = $this->PwcipAttachmentsP->find('first',array('conditions' => array('PwcipP.CIPID' => $cipid), 
			'fields' => array('PwcipP.CIPName AS Name', 'PwcipP.AttachedBudget AS Budget', 'PwcipP.ProjectPicture AS Picture')));
	
		if ($this->request->is('post') || $this->request->is('put')) { 			
			if($this->data['PwcipAttachmentsP']['Delete'] == 'NO'){	
			
				  			
			
				if(!empty($this->request->data['PwcipAttachmentsP']['FileAttachment']['name'])){
					$output = array();
					$fileid = String::uuid();
					$filename = $this->request->data['PwcipAttachmentsP']['FileAttachment']['name'];
					
					$file = new File(WWW_ROOT . 'files/'.$this->request->data['PwcipAttachmentsP']['CurrentFile'], false, 0777);
					$file->delete();
					
					$this->request->data['PwcipAttachmentsP']['Attachment'] = $fileid.'_'.$filename;
					$this->request->data['PwcipAttachmentsP']['FileAttachment']['name']	= $this->request->data['PwcipAttachmentsP']['Attachment'];		
			
					$data = Sanitize::clean($this->request->data);
					$file = $data['PwcipAttachmentsP']['FileAttachment'];
				
					$fileDestination = 'files/';	 
				
					try{
						$output = $this->FileUploader->upload($file, $fileDestination);
					}catch(Exception $e){
						$output = array('bool' => FALSE, 'error_message' => $e->getMessage());
					}
				}
				$this->PwcipAttachmentsP->Attachmentsid = $attachmentid;
				$this->PwcipAttachmentsP->save($this->request->data);
				
			} else {	
				if($this->PwcipAttachmentsP->delete($this->data['PwcipAttachmentsP']['AttachmentsID'])){
				//	$file = new File(WWW_ROOT . 'files/'.$attachment['PwcipAttachmentsP']['Attachment'], false, 0777);
				//	$file->delete();
				}
			}

			if($this->PwcipP->updateAll(array('ProjectUpdated' => 1), array('CIPID' => $cipid)))
				return $this->redirect('index/'.$cipid);
		} 		

		if (!$this->request->data) {
			$this->request->data = $attachment;
		}
		
		$attachmentscount = $this->PwcipAttachmentsP->find('count', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid)));
		$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));
		$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));
		
		$attachedbudget = ($project[0]['Budget'] == '') ? 'no' : 'yes';
		$attachedpic = ($project[0]['Picture'] == '') ? 'no' : 'yes';
	
		$this->set('updatescount', $updatescount);
		$this->set('picturescount', $picturescount);
		$this->set('attachmentscount', $attachmentscount);
		$this->set('attachedbudget', $attachedbudget);
		$this->set('attachedpic', $attachedpic);

		$this->set('name', $project[0]['Name']);
		$this->set('cipid', $cipid);
		$this->set('attachment', $attachment);
		$this->set('title', $project[0]['Name'].' |  Official Website of the City of Tucson');
	}
}