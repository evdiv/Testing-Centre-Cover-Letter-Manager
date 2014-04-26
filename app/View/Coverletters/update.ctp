<h1>Update the outcome</h1>

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
    
    echo $this->Form->input('actual_start_time', array(
      'class' => 'btn btn-warning dropdown-toggle form-inline'  
        ));
    
    echo $this->Form->input('actual_end_time', array(
      'class' => 'btn btn-warning dropdown-toggle form-inline' 
        ));
    
    echo $this->Form->input('name_of_invigilator');
    
    echo $this->Form->input('comments', array('rows' => '4'));  
    
    echo $this->Form->input('status', array(
    'options' => array('noshow' => 'Not-show'),
    'empty' => array('completed' => 'Completed'))); 
    
    echo $this->Form->input('submitted_work', array(
        'type' => 'file',
        'class' => 'btn btn-warning',
        'data-filename-placement' => 'inside',
        'title' => 'Search for a file with the submission'
        )); 
    
    echo $this->Form->hidden('id'); ?> 
    


    <div class="form-group">            
    <?php echo $this->Form->submit('Update Cover letter', array(
                  'div' => 'col col-md-9 col-md-offset-3',
                  'class' => 'btn btn-default'
          )); ?>
              
    </div>        
   <?php echo $this->Form->end(); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('input[type=file]').bootstrapFileInput();
    });
</script>
   