<h2>Add new user</h2>
<?php
echo $this->Form->create('User', array(
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
echo $this->Form->input('full_name');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->input('user_role', array(
    'options' => array('professor' => 'Professor', 'administrator' => 'Administrator')  
));

echo $this->Form->input('academic_area'); ?>

<div class="form-group">        
  <?php echo $this->Form->submit('Add new user', array(
                'div' => 'col col-md-9 col-md-offset-3',
                'class' => 'btn btn-default'
        )); ?>
</div>        
   <?php echo $this->Form->end(); ?>