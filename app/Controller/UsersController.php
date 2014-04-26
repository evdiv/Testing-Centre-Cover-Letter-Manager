<?php

class UsersController extends AppController {
    
    public function login() {
   
        //Check if it is POST request
        if($this->request->is('post')) {
            //if the login was succesfull redirect user
            
            if($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Your username/password was incorrect'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-danger'
                ));
            }
        }
    }
    
    public function logout() {
        $this->Auth->logout();
         return $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }


    public function index() {

        $this->set('users', $this->User->find('all'));
    }
    
    public function view($id = null) {
        $user = $this->User->findById($id);
        $this->set('user', $user);
    }
    public function add() {
        if($this->request->is('post')) {
            $this->User->create();
            if($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been added'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-success'
                ));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add new user'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-success'
            ));
        }
    }
}
?>
