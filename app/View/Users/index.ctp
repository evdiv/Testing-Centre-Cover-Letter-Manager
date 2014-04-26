<h1>All Users</h1>
<table class="table table-hover">
    <tr>
        <th>User name</th>
        <th>User role</th>
        <th>Password</th>  
        <th>Full name</th>          
        <th>Academic area</th>                 
    </tr>
    <?php foreach ($users as $user): ?>
     <tr>
        <td><?php echo $this->Html->link($user['User']['username'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?></td>
        <td><?php echo $user['User']['user_role']; ?></td>
        <td><?php echo $user['User']['password']; ?></td>      
        <td><?php echo $user['User']['full_name']; ?></td>
        <td><?php echo $user['User']['academic_area']; ?></td>      
     </tr>
    <?php endforeach; ?>
     
</table>
