<div>
    <div class="employee-form">
        <form class="form-container" method="POST">  
            <!-- -----------------------------------1st Row----------------------------------- -->
            <div class="form-row"> 
                <div class="form-group col-md-10">
                    <h4 class="form-header">
                        <?php 
                            if (isset($_POST['get'])) {
                                echo 'Update Employee';
                            } else {
                                echo 'Create Employee';
                            } 
                        ?> 
                    </h4>
                </div>

                <!-- ID display form -->
                <div class="form-group col-md-2">
                    <?php 
                        if (isset($_POST['get'])) {
                            echo 
                            '<div class="form-group">
                                <label>ID:</label>
                                <input type="text" name="id" class="form-control" value="'.$employeeObject[0].'" readOnly>
                            </div>';
                        } else {
                            echo '';
                        }
                    ?>
                </div>
            </div>
        
            <!-- -----------------------------------2nd Row----------------------------------- -->
            <div class="form-row">
                <!-- First name input form -->
                <div class="form-group col-md-5">
                    <label><span>First Name: </span> </label>
                    <input type="text" name="firstname" class="form-control" placeholder="First name" value="<?php 
                        // replace field with selected data if in edit mode
                        if (isset($_POST['get'])) {
                            // employeeObject[1] is firstName, [0] is ID
                            echo isset($employeeObject[1]) ? $employeeObject[1] : '';
                        } else {
                            echo isset($_POST['firstname']) ? $_POST['firstname'] : '';  
                        }
                    ?>">

                    <!-- invalid input error -->
                    <p class="form-error"> <p class="form-error"> 
                        <?php 
                            if (isset($firstNameError)) {
                                echo $firstNameError;
                            } else {
                                echo '';
                            }
                        ?> 
                    </p>
                </div>
                
                <!-- Last name input form -->
                <div class="form-group col-md-5">
                    <label><span>Last Name: </span> </label>
                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php 
                        // replace field with selected data if in edit mode
                        if (isset($_POST['get'])) {
                            // employeeObject[1] is lastName
                            echo isset($employeeObject[2]) ? $employeeObject[2] : '';
                        } else {
                            echo isset($_POST['lastname']) ? $_POST['lastname'] : '';
                        }
                    ?>">

                    <!-- invalid input error -->
                    <p class="form-error"> <p class="form-error"> 
                        <?php 
                            if (isset($lastNameError)) {
                                echo $lastNameError;
                            } else {
                                echo '';
                            }
                        ?> 
                    </p>
                </div>

                <!-- Radio buttons for selecting gender -->
                <div class="form-group col-md-1">
                    <label>Gender: </label><br />
                    <select name="gender" class="form-control">
                        <option name="gender" value="M"<?php 
                            if (isset($_POST['get'])) {
                                // [3] is gender 
                                // if gender == 'M' => checked Male button
                                echo isset($employeeObject[3]) && $employeeObject[3] == 'M' ? "selected" : "";
                            }
                        ?> selected>Male</option>
                        <option name="gender" value="F"<?php 
                            if (isset($_POST['get'])) {
                                // [3] is gender 
                                // if gender == 'M' => checked Male button
                                echo isset($employeeObject[3]) && $employeeObject[3] == 'F' ? "selected" : "";
                            }
                        ?>>Female</option>
                    </select>
                </div>

                <!-- Age input form-->
                <div class="form-group col-md-1">
                    <label>Age:</label>
                    <input type="text" name="age" class="form-control" placeholder="Age" value="<?php 
                        // replace field with selected data if in edit mode
                        if(isset($_POST['get'])) {
                            // employeeObject[4] is age
                            echo isset($employeeObject[4]) ? $employeeObject[4] : '';
                        } else {
                            echo isset($_POST['age']) ? $_POST['age'] : ''; 
                        }
                    ?>">

                    <!-- invalid input error -->
                    <p class="form-error"> <p class="form-error"> 
                        <?php 
                            if (isset($ageError)) {
                                echo $ageError;
                            } else {
                                echo '';
                            }
                        ?> 
                    </p>
                </div>
            </div>
            
            <!-- -----------------------------------3rd Row----------------------------------- -->

            <div class="form-row">
                <!-- Address input form -->
                <div class="form-group col-md-5">
                    <label><span>Address: </span> </label>
                    <input type="text" name="address" class="form-control" placeholder="Address" value="<?php 
                        // replace field with selected data if in edit mode
                        if (isset($_POST['get'])) {
                            // employeeObject[5] is address
                            echo isset($employeeObject[5]) ? $employeeObject[5] : '';
                        } else {
                            echo isset($_POST['address']) ? $_POST['address'] : ''; 
                        }
                    ?>">

                    <!-- invalid input error -->
                    <p class="form-error"> <p class="form-error"> 
                        <?php 
                            if (isset($addressError)) {
                                echo $addressError;
                            } else {
                                echo '';
                            }
                        ?> 
                    </p>
                </div>

                <!-- Phone input form -->
                <div class="form-group col-md-5">
                    <label><span>Phone: </span> </label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?php 
                        // replace field with selected data if in edit mode
                        if (isset($_POST['get'])) {
                            // [6] is phone
                            echo isset($employeeObject[6]) ? $employeeObject[6] : '';
                        } else {
                            echo isset($_POST['phone']) ? $_POST['phone'] : ''; 
                        }
                    ?>">

                    <!-- invalid input error -->
                    <p class="form-error"> <p class="form-error"> 
                        <?php 
                            if (isset($phoneError)) {
                                echo $phoneError;
                            } else {
                                echo '';
                            }
                        ?> 
                    </p>
                </div>

                <div class="form-group col-md-2">
                    <label style="visibility: hidden;"><span>Invisible Label</span> </label>
                    <?php 
                        // Button state depend on update/create mode
                        echo isset($_POST['get']) ? 
                        '<button type="submit" name="update" class="btn btn-success btn-block float-right ml-2">Update</button>' 
                        : 
                        '<button type="submit" name="create" class="btn btn-success btn-block float-right ml-2">Create</button>';
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
