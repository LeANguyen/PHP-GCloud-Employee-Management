<?php 
    // update form validation
    if (isset($_POST['update'])) {
        $isValid = true;  

        // check if name is empty or invalid character 
        if (empty($_POST['firstname']) || !preg_match("/^[a-zA-Z]*$/", $_POST['firstname'])) {
            $firstNameError = "Invalid or empty first name";
            $isValid = false;
        }

        // check if name is empty or invalid character 
        if (empty($_POST['lastname']) || !preg_match("/^[a-zA-Z]*$/", $_POST['lastname'])) {
            $lastNameError = "Invalid or empty last name";
            $isValid = false;
        }

        // check age is valid integer
        if (empty($_POST['age']) || (!preg_match("/^\d+$/", $_POST['age']))) {
            $ageError= "Invalid or empty age";
            $isValid = false;
        }

        // address cannot be empty 
        if (empty($_POST['address'])) { 
            $addressError = "Address must be provided";
            $isValid = false;
        } 

        // phone cannot be empty 
        if (empty($_POST['phone'])) { 
            $phoneError = "Phone must be provided";
            $isValid = false;
        }

        // update the employee data if all inputs are valid
        if ($isValid) {
            updateEmployee();
            unset($_POST);
        } else {
            // reload back into edit mode and show error warning
            $_POST['get'] = $_POST['id'];
            $employeeObject = array($_POST['id'], $_POST['firstname'], $_POST['lastname'], $_POST['gender'], $_POST['age'], $_POST['address'], $_POST['phone']);
        }
    }
?>