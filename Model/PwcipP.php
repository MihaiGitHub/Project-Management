<?php
App::uses('Model', 'Model');

class PwcipP extends AppModel{
	public $primaryKey = 'CIPID';
	public $name = 'PwcipP';
	
	public $hasMany = array('PwcipStatusP' => array(
									'className' => 'PwcipStatusP',
									'foreignKey' => 'CIPID',
									'order' => 'Date DESC'
									),
							'PwcipAttachmentsP' => array(
									'className' => 'PwcipAttachmentsP',
									'foreignKey' => 'CIPID',
									'order' => 'Date DESC'
									),
							'PwcipPicturesP' => array(
									'className' => 'PwcipPicturesP',
									'foreignKey' => 'CIPID',
									'order' => 'Date DESC'
									));

	public $validate = array(
		'CIPNumber' => array(
			'Numeric' => array(
				'rule' => 'numeric',
				'message' => 'Must be numeric',
				'last' => true
			),
			'Duplicate' => array(
				'rule'    => array('limitDuplicates', 1),
				'message' => 'This number has been used before.'
			)
		), 
		'CIPName' => array(
			'rule'    => 'notEmpty',
			'message' => 'Please supply the project name.'
		),
		'Type' => array(
			'rule'    => 'notEmpty',
			'message' => 'Please supply the project type.'
		)	
	);
	
	
    public function limitDuplicates($check, $limit) {
        // $check will have value: array('CIPNumber' => 'some-value')
        // $limit will have value: 1
        $existing_cipnumber_count = $this->find('count', array(
            'conditions' => $check,
            'recursive' => -1
        ));
        return $existing_cipnumber_count < $limit;
    }															
									
	function beforeValidate() {	
		if(!$this->data['PwcipP']['TotProjExpenseUpdateDate'])
			$this->data['PwcipP']['TotProjExpenseUpdateDate'] = NULL;
		if(!$this->data['PwcipP']['ProjCompletionUpdateDate'])
			$this->data['PwcipP']['ProjCompletionUpdateDate'] = NULL;
		if(!$this->data['PwcipP']['ProjCompletionDate'])
			$this->data['PwcipP']['ProjCompletionDate'] = NULL;

		$this->data['PwcipP']['TotProjExpense'] = str_replace('$', '', $this->data['PwcipP']['TotProjExpense']);
		$this->data['PwcipP']['TotProjExpense'] = str_replace(',', '', $this->data['PwcipP']['TotProjExpense']);

		if(!empty($this->data['PwcipP']['ProjDesignations'][0])){	
		
			$total = 0;
			foreach($this->data['PwcipP']['ProjDesignations'] as $item){		
				$total += $item;
			}
			$this->data['PwcipP']['ProjDesignations'] = $total;
		}
		
		if(isset($this->data['PwcipP']['TotProjExpense'][0]) && !isset($this->data['PwcipP']['TotProjExpenseUpdateDate'][0]))
			$this->data['PwcipP']['TotProjExpenseUpdateDate'] = date('m/d/Y');
	}
	
	function checkType($data, $required = false){
        $data = array_shift($data);
        
		if(!$required && $data['error'] == 4){
            return true;
        }
		
        $allowedMime = array('application/pdf');
        
		if(!in_array($data['type'], $allowedMime)){
            return false;
        }
        
		return true;
    }
	
	// Used for debugging last query (better than Cakes sql dump). In controller use: echo $this->Model->getLastQuery();
	function getLastQuery()
	{
		$dbo = $this->getDatasource();
		$logs = $dbo->getLog();
		$lastLog = end($logs['log']);
		return $lastLog['query'];
	}
}
?>