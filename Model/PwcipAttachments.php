<?php
App::uses('Model', 'Model');

class PwcipAttachments extends AppModel{
	public $primaryKey = 'AttachmentsID';
	public $name = 'PwcipAttachments';
	
	public $belongsTo = array('Pwcip' => array(
									'className' => 'Pwcip', 
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
		/*						
	function beforeValidate(){
		
		echo '<pre>111';
	print_r($this->data);
	echo '</pre>';
	//exit;
	}
	*/
//	function beforeSave(){
		
//	}
									
									
		/*						
									
	function beforeValidate() {
//	echo '<pre>111';
//	print_r($this->data);
//	echo '</pre>';

	

//	exit;
		if($this->data['PwcipStatusP']['ProjDesignations'] != 0) {
				
		
		
			$this->data['PwcipP']['TotProjExpenseUpdateDate'] = ($this->data['PwcipP']['TotProjExpenseUpdateDate'] == '') ? NULL : $this->data['PwcipP']['TotProjExpenseUpdateDate'];
			$this->data['PwcipP']['ProjCompletionDate'] = ($this->data['PwcipP']['ProjCompletionDate'] == '') ? NULL : $this->data['PwcipP']['ProjCompletionDate'];
			$this->data['PwcipP']['ProjCompletionUpdateDate'] = ($this->data['PwcipP']['ProjCompletionUpdateDate'] == '') ? NULL : $this->data['PwcipP']['ProjCompletionUpdateDate'];
			$total = 0;
			foreach($this->data['PwcipP']['ProjDesignations'] as $item){		
				$total += $item;
			}
			$this->data['PwcipP']['ProjDesignations'] = $total;
		
			//$this->data['PwcipP']['ProjDesignations'] = implode('', $this->data['PwcipP']['ProjDesignations']);
		}
	}*/	
}
?>