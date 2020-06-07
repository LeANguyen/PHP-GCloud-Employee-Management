<?php 
    // get the employee data on click the button 'get'
    // the button 'get' is the edit icon on a table row
    $employeeObject = "";
    if (isset($_POST['get'])) {
        $employeeObject = getEmployee();
    }
?>