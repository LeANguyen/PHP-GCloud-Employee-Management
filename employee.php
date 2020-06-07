
<?php 
    // include the CRUD function 
    require('employee_crud.php'); 

    // add boostrap framework
    include('bootstrap.php'); 
?>

<body>
    <?php  
        // navbar 
        include('navbar.php'); 
    ?>

    <?php 
        // error text assigned here
        $firstNameError = "";
        $lastNameError = "";
        $ageError= "";
        $addressError = "";
        $phoneError = "";

        include('controller/get.php');
        include('controller/create.php');
        include('controller/update.php');
        include('controller/delete.php');
    ?>
    
    <div class="row">
    <!-- create a form for inputing data -->
        <div class="col-sm-12">
            <?php  
                // input form goes here
                include('employee_form.php');
            ?>
        </div>

        <div class="col-sm-12">
            <?php  
                // table goes here
                include('employee_table.php');
            ?>
        </div>
    </div>
</body>
</html>
