<?php 
    // delete the selected employee when the button 'delete' is clicked
    // the button 'delete is on a table row
    if (isset($_POST['delete'])) {
        deleteEmployee();
        unset($_POST);
    }
?>