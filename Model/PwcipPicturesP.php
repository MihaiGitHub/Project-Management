<?php
App::uses('Model', 'Model');

class PwcipPicturesP extends AppModel{
	public $primaryKey = 'PicturesID';
	public $name = 'PwcipPicturesP';
	
	public $belongsTo = array('PwcipP' => array(
									'className' => 'PwcipP', 
									'foreignKey' => 'CIPID'));
																
									
	function beforeValidate(){
		if(!empty($this->data['file']['image']['name']))
			$this->data['PwcipPicturesP']['Picture'] = $this->data['file']['image']['name'];
		
	}
	
	public function beforeSave($options = array()){
		$this->data['PwcipPicturesP']['Date'] = isset($this->data['PwcipPicturesP']['Date'][0]) ? $this->data['PwcipPicturesP']['Date'] : date('m/d/Y');
	}	
}
?>