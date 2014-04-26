<?php

class Coverletter extends AppModel {
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'created_by'
        )
    );
    
    
    public $validate = array(
        
        //Validation rules when CREATE cover letter
        
       'student_name' => array(
            'rule' => array('custom', '/^[a-z A-Z]{1,100}$/i'),
            'required'   => 'create',
            'message' => 'User name must contain only letters and be maximum 100 characters long'
       ),
        'student_num' => array(
            'rule' => 'numeric',
            'required'   => 'create',
            'message' => 'User number must contain only numbers.'
        ),
        'scheduled_test_date_time' => array(
            'rule'    => array('datetime'),
            'required'   => 'create',
            'message' => 'Please enter a valid date and time.'
        ),
        'time_allowed_in_mins' => array(
            'rule' => 'numeric',
            'required'   => 'create',
            'message' => 'Allowed time must contain only numbers and be more that 0'
        ),
        'check_receipt' => array(
            'rule' => 'boolean',
            'required'   => 'create'
        ),
        'photo_id_reqd' => array(
            'rule' => 'boolean',
            'required'   => 'create'
        ),
        'fol_start_time' => array(
            'rule'    => array('datetime'),
             'allowEmpty' => true,
            'message' => 'Please enter a valid date and time.'
        ),        
        'fol_end_time' => array(
            'rule'    => array('datetime'),
             'allowEmpty' => true,
            'message' => 'Please enter a valid date and time.'
        ),
        'aids_allowed' => array(
            'rule'    => array('maxLength', '500'),
             'allowEmpty' => true,
            'message' => 'Maximum 500 characters long'
        ),
        'fol_password' => array(
            'rule'    => array('maxLength', '100'),
            'allowEmpty' => true,
            'message' => 'Maximum 100 characters long'
        ),  
        
        //Validation rules when UPDATE cover letter
        
            'actual_start_time' => array(
            'rule'    => array('datetime'),
            'required'   => false,
            'allowEmpty' => true
             ),

        'actual_start_time' => array(
            'rule'    => array('datetime'),
            'required'   => false,
            'message' => 'Please enter a valid date and time.',
            'allowEmpty' => true
            
        ),
        
        'actual_end_time' => array(
            'rule'    => array('datetime'),
            'required'   => false,
            'allowEmpty' => true,
            'message' => 'Please enter a valid date and time.'
        ),        
        
         'name_of_invigilator' => array(
            'rule' => array('custom', '/^[a-z A-Z]{1,100}$/i'),
            'required'   => false,
            'allowEmpty' => true,
            'message' => 'Name must contain only letters and maximum has 100 characters long'
        ),  
        
          'status' => array(
            'rule' => array('inList', array('approved', 'completed', 'noshow', 'submitted', 'rejected')),
            'required' => false,
            'message' => 'This status is unavailable',  
        ),
        
        'submitted_work' => array(
            'rule' => array('extension', array('doc', 'pdf')
             ),
            'message' => 'Please supply a valid document(.doc or .pdf).',
            'required' => false,
            'allowEmpty' => true
        )
    );
    
    
    
}
?>
