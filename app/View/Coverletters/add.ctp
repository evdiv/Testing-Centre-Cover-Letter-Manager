<h1>Add new cover letter</h1>

<?php 
    echo $this->Form->create('Coverletter', array(
            'inputDefaults' => array(
                'div' => 'form-group',
                'label' => array(
                    'class' => 'col col-md-3 control-label'
                ),
                'wrapInput' => 'col col-md-9',
		'class' => 'form-control'
            ),
            	'class' => 'well form-horizontal'
        ));
    
    echo $this->Form->input('student_name');
    echo $this->Form->input('student_num');
    
    echo $this->Form->input('scheduled_test_date_time', array(
      'class' => 'btn btn-warning dropdown-toggle form-inline'  
        ));
    
    echo $this->Form->input('time_allowed_in_mins'); ?>

<?php echo $this->Form->input('check_receipt', array(
		'before' => '<label class="col col-md-3 control-label">Check payment receipt</label>',
		'label' => false,
		'class' => false
            ));

    echo $this->Form->input('photo_id_reqd', array(
        'before' => '<label class="col col-md-3 control-label">Photo ID required</label>',
        'label' => false,
        'class' => false
         )); ?>


<?php echo $this->Form->input('fol_start_time', array(
      'class' => 'btn btn-warning dropdown-toggle form-inline'  
        ));
    
    echo $this->Form->input('fol_end_time', array(
      'class' => 'btn btn-warning dropdown-toggle form-inline'  
        ));
    
    echo $this->Form->input('aids_allowed', array('rows' => '3'));  
    echo $this->Form->input('fol_password');   
    
    echo $this->Form->hidden('created_by', array('default' => $user_id)); ?>

<div class="form-group">
 
  <?php echo $this->Form->submit('Add Cover letter', array(
                  'div' => 'col col-md-9 col-md-offset-3',
                  'class' => 'btn btn-default'
          ));
    echo $this->Form->end(); ?>
    
</div>