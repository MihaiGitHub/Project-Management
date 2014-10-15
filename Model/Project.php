<?php
App::uses('Model', 'Model');

class Project extends AppModel{
	public $primaryKey = 'CIPID';
	public $name = 'Project';	
	public $useTable = 'PWCIP';
	
	public $hasMany = array('ProjectAttachment' => array(
									'className' => 'ProjectAttachment',
									'foreignKey' => 'CIPID',
									'order' => 'Date DESC'
									),
							'ProjectPicture' => array(
									'className' => 'ProjectPicture',
									'foreignKey' => 'CIPID',
									'order' => 'Date DESC'
									),
							'ProjectStatus' => array(
									'className' => 'ProjectStatus',
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
	
	function beforeValidate(){
		
		
	}
}
?>