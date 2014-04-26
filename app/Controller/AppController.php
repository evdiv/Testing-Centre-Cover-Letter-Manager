<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
   
    
public $helpers = array(
		'Session',
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
    
    
public $components = array(
  'Session',
    'Auth' => array(
        'loginRedirect' => array('controller' => 'coverletters', 'action' => 'index'),
        'logoutRedirect' => array('controller' => 'coverletters', 'action' => 'index'), 
        'authError' => 'You can not access that page',
        'authorize' => array('Controller'),
        'flash' => array(
        'element' => 'alert',
        'key' => 'auth',
        'params' => array(
                'plugin' => 'BoostCake',
                'class' => 'alert-error'
                )
        )
    )
);


//User who authorized has access to any page
public function isAuthorized($user) {
    return true;
}

public function beforeFilter() {
    
    //Not authorized users can access
    //$this->Auth->allow('index', 'view', 'add');
    
    //Set variables to the views
    $this->set('logged_in', $this->Auth->loggedIn());
    $this->set('current_user', $this->Auth->user());
    $this->set('user_role', $this->Auth->user('user_role'));    
   
    //Get the number of all coverletters to be schedulled today
    //Load model for getting access to it from others objects.
    $this->loadModel('Coverletter');
    $schedulled_coverletters = $this->Coverletter->find('count', array(
        'conditions' => array(
           'Coverletter.scheduled_test_date_time <' => date('Y-m-d', strtotime(' +1 day')),
           'Coverletter.scheduled_test_date_time >' => date('Y-m-d', strtotime(' -1 day')),
           'Coverletter.status' => 'submitted'
        )
    ));
    
    $this->set('schedulled_coverletters', $schedulled_coverletters);     
}

}
