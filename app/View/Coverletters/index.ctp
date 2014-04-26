<h3>All Cover Letters</h3>

<table class="table table-hover">
    <tr>
        <th>Scheduled test time</th>
        <th>Student name</th>
        <th>Student ID</th>  
        <th>Professor</th>          
        <th>Test duration</th>        
        <th>Status</th>
        <th>Available Actions</th>   
        <th></th>           
    </tr>
    <?php foreach ($coverletters as $coverletter): ?>
    
    <?php $coverletter_id = $coverletter['Coverletter']['id']; ?>
    
    <tr>
        <td><?php echo $coverletter['Coverletter']['scheduled_test_date_time']; ?></td>
        <td><?php echo $coverletter['Coverletter']['student_name']; ?></td>
        <td><?php echo $coverletter['Coverletter']['student_num']; ?></td>       
        <td><?php echo $coverletter['User']['full_name']; ?></td>        
        <td><?php echo $coverletter['Coverletter']['time_allowed_in_mins'] . " min."; ?></td>
        <td><?php echo $coverletter['Coverletter']['status']; ?></td>       
        <td> 
            
    <?php 
    
    if($user_role == 'professor' && $coverletter['Coverletter']['status'] == 'submitted') { 
    echo $this->Html->link('edit', 
                array('controller' => 'coverletters', 'action' => 'edit', $coverletter_id),
                array('class' => 'btn btn-default btn-xs')); 
    }
        
    if($user_role == 'administrator') { 
        if($coverletter['Coverletter']['status'] == 'submitted' || $coverletter['Coverletter']['status'] == 'rejected') {
            echo $this->Form->postLink('approve', 
            array('controller' => 'coverletters', 'action' => 'approve', $coverletter_id),
                array('class' => 'btn btn-success btn-xs'));
        }
        if($coverletter['Coverletter']['status'] == 'submitted' || $coverletter['Coverletter']['status'] == 'approved') {
            echo " " . $this->Form->postLink('reject', 
            array('controller' => 'coverletters', 'action' => 'reject', $coverletter_id),
                    array('class' => 'btn btn-danger btn-xs')); 
        }
        if($coverletter['Coverletter']['status'] != 'rejected') {
            echo " " . $this->Html->link('update', 
            array('controller' => 'coverletters', 'action' => 'update', $coverletter_id),
                    array('class' => 'btn btn-default btn-xs'));   
        }
    } 
    ?>
        
        </td> 
        <td>
    <?php echo $this->Html->link('More info...',
        array('controller'=>'coverletters', 'action'=>'view', $coverletter_id)); ?>
        </td>     
        
    </tr>
    <?php endforeach; ?>
</table>