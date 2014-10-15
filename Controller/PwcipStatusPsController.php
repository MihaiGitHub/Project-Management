<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('String', 'Utility');

class PwcipStatusPsController extends AppController {
	public $name = 'PwcipStatusPs';
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Paginator');	
	public $uses = array('PwcipP', 'PwcipPicturesP', 'PwcipAttachmentsP', 'PwcipStatusP');
	
	public function admin_index($cipid = null){
		if (!$cipid) {
			throw new NotFoundException(__('Invalid Project'));
		}
		
		$project = $this->PwcipP->find('first',array('conditions' => array('PwcipP.CIPID' => $cipid), 
			'fields' => array('PwcipP.CIPName AS Name')));

		$statuses = $this->PwcipStatusP->find('all', array('conditions' => array('PwcipStatusP.CIPID' => $cipid),
														   'order' => array('PwcipStatusP.Date DESC')));
		$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));
		$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));
		$attachmentscount = $this->PwcipAttachmentsP->find('count', array('conditions' => array('PwcipAttachmentsP.CIPID' => $cipid)));
				
		$attachedbudget = ($statuses[0]['PwcipP']['AttachedBudget'] == '') ? 'no' : 'yes';
		$attachedpic = ($statuses[0]['PwcipP']['ProjectPicture'] == '') ? 'no' : 'yes';
	
		$this->set('updatescount', $updatescount);
		$this->set('picturescount', $picturescount);
		$this->set('attachmentscount', $attachmentscount);
		$this->set('attachedbudget', $attachedbudget);
		$this->set('attachedpic', $attachedpic);
		$this->set('statuses', $statuses);
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

		$project = $this->PwcipP->find('first',array('conditions' => array('PwcipP.CIPID' => $cipid), 
			'fields' => array('PwcipP.CIPName AS Name', 'PwcipP.AttachedBudget AS Budget', 'PwcipP.ProjectPicture AS Picture')));

		if ($this->request->is('post')) {
$this->request->data['PwcipStatusP']['Status'] = str_replace("<br><br>", "<p>", str_replace("\n", "<br>", $this->request->data['PwcipStatusP']['Status']) );
		
			if ($this->PwcipStatusP->save($this->request->data)) {
				if($this->PwcipP->updateAll(array('ProjectUpdated' => 1), array('CIPID' => $cipid)))
					return $this->redirect('index/'.$cipid);
			} 
			
		}
		$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));
		$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));
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
		$this->set('title', $project[0]['Name'].' |  Official Website of the City of Tucson');
	}
	
	public function admin_edit($statusid = null){
		if (!$statusid) {
			throw new NotFoundException(__('Invalid Project'));
		}
		$status = $this->PwcipStatusP->findByStatusid($statusid);
		$status['PwcipStatusP']['Status'] = str_replace("<br>", "\n", str_replace("<p>", "\n\n", $status['PwcipStatusP']['Status']));

		$cipid = $status['PwcipStatusP']['CIPID'];
        if (!$status) {
            throw new NotFoundException(__('Invalid Project'));
        }
		$project = $this->PwcipStatusP->find('first',array('conditions' => array('PwcipP.CIPID' => $cipid), 
			'fields' => array('PwcipP.CIPName AS Name', 'PwcipP.AttachedBudget AS Budget', 'PwcipP.ProjectPicture AS Picture')));

		if ($this->request->is('post') || $this->request->is('put')) { 
			if($this->data['PwcipStatusP']['Delete'] == 'NO'){	
$this->request->data['PwcipStatusP']['Status'] = str_replace("<br><br>", "<p>", str_replace("\n", "<br>", $this->request->data['PwcipStatusP']['Status']) );
			
				$this->PwcipStatusP->Statusid = $statusid;
				$this->PwcipStatusP->save($this->request->data);
			} else {	
				$this->PwcipStatusP->delete($this->data['PwcipStatusP']['StatusID']);
			}		

			if($this->PwcipP->updateAll(array('ProjectUpdated' => 1), array('CIPID' => $cipid)))
				return $this->redirect('index/'.$cipid);
		} 

		if (!$this->request->data) {
			$this->request->data = $status;
		}
		$updatescount = $this->PwcipStatusP->find('count', array('conditions' => array('PwcipStatusP.CIPID' => $cipid)));
		$picturescount = $this->PwcipPicturesP->find('count', array('conditions' => array('PwcipPicturesP.CIPID' => $cipid)));		
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
		$this->set('status', $status);
		$this->set('title', $project[0]['Name'].' |  Official Website of the City of Tucson');
	}
}