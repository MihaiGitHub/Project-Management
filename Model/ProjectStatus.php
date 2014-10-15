<?php
App::uses('Model', 'Model');

class ProjectStatus extends AppModel{
	public $primaryKey = 'StatusID';
	public $name = 'ProjectStatus';
	public $useTable = 'PWCIP_Status';

	public $belongsTo = array('Project' => array(
									'className' => 'Project', 
									'foreignKey' => 'CIPID'));
									
}
?>