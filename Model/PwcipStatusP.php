<?php
App::uses('Model', 'Model');

class PwcipStatusP extends AppModel{
	public $primaryKey = 'StatusID';
	public $name = 'PwcipStatusP';
	
	public $belongsTo = array('PwcipP' => array(
									'className' => 'PwcipP', 
									'foreignKey' => 'CIPID'));
									
	public function beforeSave($options = array()){
		$this->data['PwcipStatusP']['Date'] = isset($this->data['PwcipStatusP']['Date'][0]) ? $this->data['PwcipStatusP']['Date'] : date('m/d/Y');
	}			
}
?>