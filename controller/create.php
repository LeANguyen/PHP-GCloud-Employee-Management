<?php 
    // create form validation
    if(isset($_POST['create'])) {
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

        // if all input valid, create new employee
        if ($isValid) {
            createEmployee();
            unset($_POST);
        }
    }
?>