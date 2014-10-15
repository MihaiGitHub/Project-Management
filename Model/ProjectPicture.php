<?php
App::uses('Model', 'Model');

class ProjectPicture extends AppModel{
	public $primaryKey = 'PicturesID';
	public $name = 'ProjectPicture';
	public $useTable = 'PWCIP_Pictures';
	
	public $belongsTo = array('Project' => array(
									'className' => 'Project', 
									'foreignKey' => 'CIPID'));
									
	function beforeValidate(){
		if(!empty($this->data['file']['image']['name']))
			$this->data['ProjectPicture']['Picture'] = $this->data['file']['image']['name'];
		
	}
}
?>