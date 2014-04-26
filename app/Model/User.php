<?php

class User extends AppModel {

    public $hasMany = array(
        'Coverletter' => array(
            'className' => 'Coverletter',
            'foreignKey' => 'created_by'
        )
    );
    public $hasOne = array(
        'Usersession' => array(
            'className' => 'Usersession',
            'foreignKey' => 'parent_user'
        )
    );
    
    public $validate = array(
        
        'username' => array(
                'rule' => array('between', 4,10),
                'message' => 'Username must be between 5 and 15 characters'
        ),
        'password' => array(
            'rule' => 'notEmpty',
            'message' => 'Password must not to be empty'
        ),
        'user_role' => array(
            'rule' => array('inList', array('professor', 'administrator')),
            'message' => 'User role must be either professor or administrator'
        ),
        'full_name' => array(
            'rule' => array('custom', '/^[a-z A-Z]{1,100}$/i'),
            'message' => 'User name must contain only letters and be maximum 100 characters long'                 
        ),
        'academic_area' => array(
            'rule' => array('custom', '/^[a-z A-Z]{1,100}$/i'),
            'message' => 'Academic area must contain only letters and be maximum 100 characters long'                
        )
        
    );
    
    //Hash submitted password before it save in the DB
    
    public function beforeSave($options = array()) {
        if(isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
            return true; 
        } else {
            return false;
        }
    }
}

?>
