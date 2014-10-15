<?php
App::uses('Model', 'Model');

class ProjectAttachment extends AppModel{
	public $primaryKey = 'AttachmentsID';
	public $name = 'ProjectAttachment';
	public $useTable = 'PWCIP_Attachments';
	
	public $belongsTo = array('Project' => array(
									'className' => 'Project', 
									'foreignKey' => 'CIPID'));

	public $validate = array(
		'AttachmentTitle' => array(
			'rule'    => 'notEmpty',
			'message' => 'Please supply a valid attachment title.'
		),
		'FileAttachment.name' => array(
			'rule'    => array('extension', array('pdf')),
			'message' => 'Please supply a valid file.'
		)
	);	
}
?>