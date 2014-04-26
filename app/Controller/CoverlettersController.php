<?php

class CoverlettersController extends AppController {

    public function index($status = null) {
        
       //if the current user is a proffesor show only his/her coverletters
        if($this->Auth->user('user_role') == 'professor') {
            
            $this->set('coverletters', $this->Coverletter->find('all', array(
            'conditions' => array(
             'Coverletter.created_by' => $this->Auth->user('id')
            ))));
        } else {
            if(isset($status) && $status != 'today') {
                $this->set('coverletters', $this->Coverletter->find('all' , array(
                    'conditions' => array(
                        'Coverletter.status' => $status,
                    )))); 
            } elseif($status == 'today') {
                $this->set('coverletters', $this->Coverletter->find('all' , array(
                    'conditions' => array(
                        'Coverletter.scheduled_test_date_time <' => date('Y-m-d', strtotime(' +1 day')),
                        'Coverletter.scheduled_test_date_time >' => date('Y-m-d', strtotime(' -1 day'))
                    ))));                 
            } else {
                $this->set('coverletters', $this->Coverletter->find('all'));
            }
        }
    }

    public function view($id = null) {
        
        //Check if the id was set and coverletter exist in the DB
        if(!$id || !$this->Coverletter->exists($id)) {
           throw new NotFoundException(__('ID was not set'));
        }
        
        $coverLetter = $this->Coverletter->findById($id);
        
         //Professors can see only their cover letter so 
         //restrict access if the user is professor but the cover letter does't belong to him/her
        if($this->Auth->user('user_role') == 'professor' && 
                $coverLetter['Coverletter']['created_by'] != $this->Auth->user('id')) {
            $this->Session->setFlash('You can see details only your cover letter');
            return $this->redirect(array('controller' => 'coverletters', 'action' => 'index'));
                }
        
        $this->set('coverletter', $this->Coverletter->findById($id));
    }

    public function add() {
        
        //Restrict the operation from being consumed by a non-professor.
        if($this->Auth->user('user_role') != 'professor') {
            $this->Session->setFlash(__('Only proffesors can add new cover letters'));
            return $this->redirect(array('action' => 'index')); 
        }
        
        $this->set('user_id', $this->Auth->user('id'));  
        if ($this->request->is('post')) {
            $this->Coverletter->create();
            if ($this->Coverletter->save($this->request->data)) {
                $this->Session->setFlash(__('The cover letter has been saved.'), 'alert', array(
                   'plugin' => 'BoostCake',
                   'class' => 'alert-success'
                ));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your cover letter'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
        }
    }

    public function edit($id = null) {
  
        //Check if the id was set and coverletter exist in the DB
        if(!$id || !$this->Coverletter->exists($id)) {
           throw new NotFoundException(__('ID was not set'));
        }
        
        $coverLetter = $this->Coverletter->findById($id);
        
        //Get the current user is the owner of it
        $current_user = $this->Auth->user();
        
        //Administrators can't edit the cover letters
        if($current_user['user_role'] == 'administrator') {
            $this->Session->setFlash(__('Only professors can edit cover letters!'));
            return $this->redirect(array('action' => 'index')); 
        }
        
        //Check is the cover letter belongs to the professor
        if($coverLetter['Coverletter']['created_by'] != $current_user['id']) {
            $this->Session->setFlash(__('You can edit only your cover letters!'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
            return $this->redirect(array('action' => 'index')); 
        }
        
        //Check if the cover letter in the Submitted state
        if($coverLetter['Coverletter']['status'] != 'submitted') {
            $this->Session->setFlash(__('You can edit only cover letters in the Submitted state!'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
            return $this->redirect(array('action' => 'index')); 
        } 
         
        //Put the Coverletter object to the request data
        if (!$this->request->data) {
            $this->request->data = $coverLetter;
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Coverletter->id = $id;

            if ($this->Coverletter->save($this->request->data)) {
                $this->Session->setFlash(__('The cover letter has been edited.'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-success'
                ));
                
                return $this->redirect(array('action' => 'index'));
            }
        $this->Session->setFlash(__('Unable to edit your cover letter'), 'alert', array(
            'plugin' => 'BoostCake',
            'class' => 'alert-danger'
        ));
        }
    }
    public function approve($id = null) {
        
        //Check if the ID was set and entry exist in the DB
        if(!$id || !$this->Coverletter->exists($id)) {
           throw new NotFoundException(__('ID was not set'));
        }
        
        //If the current user isn't an administrator restrict the action
        if($this->Auth->user('user_role') != 'administrator') {
            $this->Session->setFlash(__('You do not have enough privileges for this action'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
            return $this->redirect(array('action' => 'index'));
        }
        
        //Check if the method was POST
       if ($this->request->is('post')) {
           
           $coverLetter = $this->Coverletter->findById($id);
           $coverLetter['Coverletter']['status'] = 'approved';
           
           if (!$this->request->data) {
           $this->request->data = $coverLetter;
           
              if ($this->Coverletter->save($this->request->data)) {
              $this->Session->setFlash(__('The cover letter has been approved.'), 'alert', array(
                  'plugin' => 'BoostCake',
                  'class' => 'alert-success'
              ));
              return $this->redirect(array('action' => 'index'));
              }
           }
         }  
    }
    
    public function reject($id = null) {
        
        //Check if the ID was set and entry exist in the DB
        if(!$id || !$this->Coverletter->exists($id)) {
           throw new NotFoundException(__('ID was not set'));
        }
        
         //If the current user isn't an administrator restrict the action
        if($this->Auth->user('user_role') != 'administrator') {
            $this->Session->setFlash(__('You do not have enough privileges for this action'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-success'
            ));
            return $this->redirect(array('action' => 'index'));
        }
        
        //Check if the method was POST
       if ($this->request->is('post')) {

       }
        
        $coverLetter = $this->Coverletter->findById($id); 
        $coverLetter['Coverletter']['status'] = 'rejected';
        
        
        if (!$this->request->data) {
            $this->request->data = $coverLetter;
        }
        
        if ($this->Coverletter->save($this->request->data)) {
                $this->Session->setFlash(__('The cover letter has been rejected.'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-info'
                ));
                return $this->redirect(array('action' => 'index'));
         }  
    }
    public function update($id = null) {
        
        //Check if the ID was set and entry exist in the DB
        if(!$id || !$this->Coverletter->exists($id)) {
           throw new NotFoundException(__('ID was not set'), 'alert', array(
               'plugin' => 'BoostCake',
               'class' => 'alert-danger'
           ));
        }
        
        //Restrict the action if the current user isn't administrator
        if($this->Auth->user('user_role') != 'administrator') {
            $this->Session->setFlash(__('Only administrators can update final outcome of the cover letters'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
            return $this->redirect(array('action' => 'index'));
        }
        
        $coverLetter = $this->Coverletter->findById($id);
                        
        if (!$this->request->data) {
            $this->request->data = $coverLetter;
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Coverletter->id = $id;

            if ($this->Coverletter->save($this->request->data)) {
                $this->Session->setFlash(__('The cover letter has been edited.'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-success'
                ));
                return $this->redirect(array('action' => 'index'));
            }
        $this->Session->setFlash(__('Unable to update the cover letter'), 'alert', array(
            'plugin' => 'BoostCake',
            'class' => 'alert-danger'
        ));
        }
   }
} 
?>
