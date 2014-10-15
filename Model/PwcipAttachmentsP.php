<?php
App::uses('Model', 'Model');

class PwcipAttachmentsP extends AppModel{
	public $primaryKey = 'AttachmentsID';
	public $name = 'PwcipAttachmentsP';
	
	public $belongsTo = array('PwcipP' => array(
									'className' => 'PwcipP', 
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
	
	public function beforeSave($options = array()){
		$this->data['PwcipAttachmentsP']['Date'] = isset($this->data['PwcipAttachmentsP']['Date'][0]) ? $this->data['PwcipAttachmentsP']['Date'] : date('m/d/Y');
	}
}
?>