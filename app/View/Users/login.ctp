<h2>Login</h2>

 <?php echo $this->Form->create('User', array(
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
        
        echo $this->Form->input('username');
        echo $this->Form->input('password'); ?>
        
<div class="form-group">        
  <?php echo $this->Form->submit('Login', array(
                'div' => 'col col-md-9 col-md-offset-3',
                'class' => 'btn btn-default'
        )); ?>
</div>        
   <?php echo $this->Form->end(); ?>

<div class="row">
    <div class="col-xs-6">
        <h4>User name: testprof</h4>
        <h4>Password: test</h4>
        <h4>Role: Professor</h4>    
        <hr>
        <h4>User name: testprof2</h4>
        <h4>Password: test</h4>
        <h4>Role: Professor</h4>  
    </div>
    
    
  <div class="col-xs-6">
        <h4>User name: testadmin</h4>
        <h4>Password: test</h4>
        <h4>Role: Testing Centre Administrator</h4>        
  </div>
</div>
