<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('String', 'Utility');
App::uses('CakeNumber', 'Utility');
App::uses('File', 'Utility');

class ProjectsController extends AppController {
	public $name = 'Projects';
	public $helpers = array('Html', 'Form', 'Session');
	public $uses = array('Project', 'PwcipP', 'PwcipPicturesP', 'ProjectPicture', 'PwcipAttachmentsP', 'ProjectAttachment', 'ProjectStatus', 'PwcipStatusP');
	
    public function review_index(){
		$conditions['AND']['PwcipP.ProjectUpdated'] = 1;
		
		$projects = $this->PwcipP->find('all', array('conditions' => $conditions, 'order' => 'CIPName ASC'));
		
		$data = array();
		foreach($projects as $project){
			$project['count'] = $this->Project->find('count', array('conditions' => array('CIPID' => $project['PwcipP']['CIPID']),'recursive' => -1));
			$data[] = $project;
		}
		
		$this->set('projects', $data);
		$this->set('title', 'Downtown Projects | Official Website of the City of Tucson');
    }
	
	public function beforeFilter() { 
        parent::beforeFilter();
    }
	
	public function review_approve($CIPID = null){ 
		if (!$CIPID) {
			throw new NotFoundException(__('Invalid Project'));
		}
				
		if($this->request->isPost()){ 
		
			if (!empty($this->request->data)) {					
				
				if(isset($this->request->data['delete'])){					
					
					// Delete everything from PwcipP tables
					if(isset($this->request->data['ProjectPictures'])){
					if($this->PwcipPicturesP->deleteAll(array('PwcipPicturesP.CIPID' => $this->request->data['Project']['CIPID']))){						
						foreach($this->request->data['ProjectPictures'] as $picture){
							$file = new File(WWW_ROOT . 'pictures/'.$picture['Picture'], false, 0777);
							$file->delete();
						}
					}
					}
					
					if(isset($this->request->data['ProjectAttachments'])){
					if($this->PwcipAttachmentsP->deleteAll(array('PwcipAttachmentsP.CIPID' => $this->request->data['Project']['CIPID']))){
						foreach($this->request->data['ProjectAttachments'] as $attach){
							$file = new File(WWW_ROOT . 'files/'.$attach['Attachment'], false, 0777);
							$file->delete();
						}
					}
					}
					
					if(!empty($this->request->data['Project']['AttachedBudget'])){
						$file = new File(WWW_ROOT . 'files/budget/'.$this->request->data['Project']['AttachedBudgetNew'], false, 0777);
						$file->delete();
					}
					
					if(isset($this->request->data['Project']['ProjectStatus'])){
						$this->PwcipStatusP->deleteAll(array('ProjectStatusP.CIPID' => $this->request->data['Project']['CIPID']));
					}
						
					if($this->PwcipP->deleteAll(array('PwcipP.CIPID' => $this->request->data['Project']['CIPID']))){
						$file = new File(WWW_ROOT . 'pictures/'.$this->request->data['Project']['ProjectPictureNew'], false, 0777);
						$file->delete();
					}
					
					// Delete everything from Project tables
					if(isset($this->request->data['ProjectPictures'])){
					if($this->ProjectPicture->deleteAll(array('ProjectPicture.CIPID' => $this->request->data['Project']['CIPID']))){
						foreach($this->request->data['ProjectPicture'] as $picture){
							$file = new File(WWW_ROOT . 'pictures/'.$picture['Picture'], false, 0777);
							$file->delete();
						}
					}
					}
					
					if(isset($this->request->data['ProjectAttachment'])){
					if($this->ProjectAttachment->deleteAll(array('ProjectAttachments.CIPID' => $this->request->data['Project']['CIPID']))){
						foreach($this->request->data['ProjectAttachment'] as $attach){
							$file = new File(WWW_ROOT . 'files/'.$attach['Attachment'], false, 0777);
							$file->delete();
						}
					}
					}
					
					if(!empty($this->request->data['Project']['AttachedBudget'])){
						$file = new File(WWW_ROOT . 'files/budget/'.$this->request->data['Project']['AttachedBudgetOld'], false, 0777);
						$file->delete();
					}
					
					$this->ProjectStatus->deleteAll(array('ProjectStatus.CIPID' => $this->request->data['Project']['CIPID']));
							
					if($this->Project->deleteAll(array('Project.CIPID' => $this->request->data['Project']['CIPID']))){
						$file = new File(WWW_ROOT . 'pictures/'.$this->request->data['Project']['ProjectPictureOld'], false, 0777);
						$file->delete();
					}
				} else if (isset($this->request->data['cancel'])){ 
					$this->PwcipP->updateAll(array('ProjectDeleted' => 0, 'ProjectUpdated' => 0), array('CIPID' => $this->request->data['Project']['CIPID']));
				} else {
					if($this->Project->save($this->request->data)){
						if(!empty($this->request->data['ProjectStatus'])){
							foreach($this->request->data['ProjectStatus'] as $stat){
								$this->Project->ProjectStatus->save($stat);						
							}
						}
						
						if(!empty($this->request->data['ProjectPicture'])){
							foreach($this->request->data['ProjectPicture'] as $pic){
								$this->Project->ProjectPicture->save($pic);
							}
						}
						
						if(!empty($this->request->data['ProjectAttachment'])){
							foreach($this->request->data['ProjectAttachment'] as $attach){
								$this->Project->ProjectAttachment->save($attach);
							}
						}
					}
					
				}	
			}
		if($this->PwcipP->updateAll(array('ProjectUpdated' => 0), array('CIPID' => $this->request->data['Project']['CIPID'])))
				return $this->redirect(array('action' => 'index/'));
		}
		$old = $this->Project->find('first',array('conditions' => array('Project.CIPID' => $CIPID)));
		$new = $this->PwcipP->find('first',array('conditions' => array('PwcipP.CIPID' => $CIPID)));
		
		$this->set('CIPID', $CIPID);
		$this->set('old', $old);
		$this->set('new', $new);
		$this->set('title', $new['PwcipP']['CIPName'].' | Official Website of the City of Tucson');
	}
	
	// Outward facing site
	public function project($cipid = null){
		$this->theme = 'External';
		if (!$cipid) {
            throw new NotFoundException(__('Invalid Project1'));
        }

        $project = $this->Project->findByCipid($cipid);
        if (!$project) {
            throw new NotFoundException(__('Invalid Project2'));
        }
		
		//////////////////////////// STATUS
		$statuses = $this->ProjectStatus->find('all', array('conditions' => array('ProjectStatus.CIPID' => $cipid),
															'order' => array('ProjectStatus.Date DESC')));
		$this->set('statuses', $statuses);

		//////////////////////////////////////
		///////////////////////////////PICTURES
		$pictures = $this->ProjectPicture->find('all', array('conditions' => array('ProjectPicture.CIPID' => $cipid),
															 'order' => array('ProjectPicture.Date DESC')));

		$this->set('pictures', $pictures);
		////////////////////////////////////////
		/////////////////////////////ATTACHMENTS
		$attachments = $this->ProjectAttachment->find('all', array('conditions' => array('ProjectAttachment.CIPID' => $cipid),
																   'order' => array('ProjectAttachment.Date DESC')));

		$this->set('attachments', $attachments);
		////////////////////////////////////////
		$this->Session->write('CIPNumber', $project['Project']['CIPNumber']);
		$this->set('project', $project);
		$this->set('cipid', $cipid);
		$this->set('title', $project['Project']['CIPName'].' | Official Website of the City of Tucson');
	}
	public function all(){
		
		$this->theme = 'External';
			
		$pdrainage = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Drainage'), 'order' => array('Project.CIPName')));
		$pfacilities = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Facilities'), 'order' => array('Project.CIPName')));
		$pmiscellaneous = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Miscellaneous'), 'order' => array('Project.CIPName')));
		$psignal = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Signal'), 'order' => array('Project.CIPName')));
		$ptransportation = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Transportation'), 'order' => array('Project.CIPName')));
		$pwastewater = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Wastewater'), 'order' => array('Project.CIPName')));
		$pwater = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Water'), 'order' => array('Project.CIPName')));
		
		$this->set('pdrainage', $pdrainage);
		$this->set('pfacilities', $pfacilities);
		$this->set('pmiscellaneous', $pmiscellaneous);
		$this->set('psignal', $psignal);
		$this->set('ptransportation', $ptransportation);
		$this->set('pwastewater', $pwastewater);
		$this->set('pwater', $pwater);
		$this->set('main', true);
		$this->set('title', 'Downtown Projects | Official Website of the City of Tucson');
	}

	public function current(){
		
		$this->theme = 'External';
			
		$pdrainage = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Drainage', 'Project.Status !=' => 'Completed'), 'order' => array('Project.CIPName')));
		$pfacilities = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Facilities', 'Project.Status !=' => 'Completed'), 'order' => array('Project.CIPName')));
		$pmiscellaneous = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Miscellaneous', 'Project.Status !=' => 'Completed'), 'order' => array('Project.CIPName')));
		$psignal = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Signal', 'Project.Status !=' => 'Completed'), 'order' => array('Project.CIPName')));
		$ptransportation = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Transportation', 'Project.Status !=' => 'Completed'), 'order' => array('Project.CIPName')));
		$pwastewater = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Wastewater', 'Project.Status !=' => 'Completed'), 'order' => array('Project.CIPName')));
		$pwater = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Water', 'Project.Status !=' => 'Completed'), 'order' => array('Project.CIPName')));
		
		
		
		$this->set('pdrainage', $pdrainage);
		$this->set('pfacilities', $pfacilities);
		$this->set('pmiscellaneous', $pmiscellaneous);
		$this->set('psignal', $psignal);
		$this->set('ptransportation', $ptransportation);
		$this->set('pwastewater', $pwastewater);
		$this->set('pwater', $pwater);
		$this->set('main', true);
		$this->set('title', 'Downtown Projects | Official Website of the City of Tucson');
	}
	
	public function completed(){
		
		$this->theme = 'External';
		
		$pdrainage = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Drainage', 'Project.Status' => 'Completed'), 'order' => array('Project.CIPName DESC')));
		$pfacilities = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Facilities', 'Project.Status' => 'Completed'), 'order' => array('Project.CIPName DESC')));
		$pmiscellaneous = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Miscellaneous', 'Project.Status' => 'Completed'), 'order' => array('Project.CIPName DESC')));
		$psignal = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Signal', 'Project.Status' => 'Completed'), 'order' => array('Project.CIPName DESC')));
		$ptransportation = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Transportation', 'Project.Status' => 'Completed'), 'order' => array('Project.CIPName DESC')));
		$pwastewater = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Wastewater', 'Project.Status' => 'Completed'), 'order' => array('Project.CIPName DESC')));
		$pwater = $this->Project->find('all', array('conditions' => array('Project.Type' => 'Water', 'Project.Status' => 'Completed'), 'order' => array('Project.CIPName DESC')));
			
		$this->set('pdrainage', $pdrainage);
		$this->set('pfacilities', $pfacilities);
		$this->set('pmiscellaneous', $pmiscellaneous);
		$this->set('psignal', $psignal);
		$this->set('ptransportation', $ptransportation);
		$this->set('pwastewater', $pwastewater);
		$this->set('pwater', $pwater);
		$this->set('main', true);
		$this->set('title', 'Downtown Projects | Official Website of the City of Tucson');
	}
}