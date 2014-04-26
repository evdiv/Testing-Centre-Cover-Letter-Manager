<?php

class Usersession extends AppModel {
   
 public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'parent_user'
        )
    );
}

?>
