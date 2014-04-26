<h3>Cover Letter</h3>

    <hr />
<div class="alert alert-dismissable alert-info">
    <p><?php echo "<b>Student Name:</b> " . $coverletter['Coverletter']['student_name']; ?></p>
    <p><?php echo " <b>Student Number:</b> " . $coverletter['Coverletter']['student_num']; ?></p>
    <p><?php echo "<b>Instructor Name:</b> " . $coverletter['User']['full_name']; ?> </p> 
    <p><?php echo "<b>Academic Area:</b> " . $coverletter['User']['academic_area']; ?> </p> 
</div>
    
 <p class="text-primary"><?php echo "<b>Scheduled Test Date:</b> " . $coverletter['Coverletter']['scheduled_test_date_time']; ?></p>
<div class="alert alert-dismissable alert-danger">
    <p><?php echo "<b>Check Test Payment Receipt: </b> " . 
             (($coverletter['Coverletter']['check_receipt'] == 1) ? "Yes" : "No"); ?></p> 

    <p><?php echo " <b>Photo ID Required: </b> " . 
             (($coverletter['Coverletter']['photo_id_reqd'] == 1) ? "Yes" : "No"); ?></p> 

    <p><?php echo "<b>Password (if necessary): </b> " . 
     (!empty($coverletter['Coverletter']['fol_password']) ? $coverletter['Coverletter']['fol_password'] : "-"); ?></p> 
</div>
    <hr />
    <p><?php echo "<b>Time allowed:</b> " . $coverletter['Coverletter']['time_allowed_in_mins'] . " min."; ?></p>

    <p><?php echo "<b>FOL Start/End Time:</b> " . $coverletter['Coverletter']['fol_start_time'] . "  /  "
            . $coverletter['Coverletter']['fol_end_time'] . " min."; ?></p>

   <hr /> 
     <h4>To be completed by Test Centre Staff</h4>
    <div class="alert alert-dismissable alert-success">

     <p><?php echo "<b>Name of Invigilator:</b> " . 
       (!empty($coverletter['Coverletter']['name_of_invigilator']) ? $coverletter['Coverletter']['name_of_invigilator'] : "-"); ?></p> 

     <p><?php echo "<b>Actual start time:</b> " . 
             (isset($coverletter['Coverletter']['actual_start_time']) ? $coverletter['Coverletter']['actual_start_time'] : "-"); ?></p>

     <p><?php echo "<b>Actual end time:</b> " . 
             (isset($coverletter['Coverletter']['actual_end_time']) ? $coverletter['Coverletter']['actual_end_time'] : "-"); ?></p>

     <p><?php echo "<b>Comments:</b> " . 
             (!empty($coverletter['Coverletter']['comments']) ? $coverletter['Coverletter']['comments'] : "-"); ?></p>        

    <p><?php echo "<b>Submitted work:</b> " . 
            (!empty($coverletter['Coverletter']['submitted_work']) ? $coverletter['Coverletter']['submitted_work'] : "-"); ?></p>    
    
    </div>