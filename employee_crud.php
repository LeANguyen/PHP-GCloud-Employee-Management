<?php
    // create new employee
    // gs://cloud-a1/employees.csv
    define('bucketLink', 'gs://cloud-a1/employees.csv'); 
    function createEmployee() {
        if(file_exists(bucketLink)) {
            // read the csv file and put all line into an array
            $csvFileLines = file(bucketLink, FILE_IGNORE_NEW_LINES);

            // get the last line in the array
            $lastEmployee = end($csvFileLines);

            // split the last line by ','
            $lastEmployeeObject = explode(",", $lastEmployee); 

            // new Employee ID = last Employee ID + 1
            $newEmployeeID = $lastEmployeeObject[0] + 1;

            // create the newest employee line from user input
            $csvFileLines[count($csvFileLines)] = "{$newEmployeeID},{$_POST['firstname']},{$_POST['lastname']},{$_POST['gender']},{$_POST['age']},{$_POST['address']},{$_POST['phone']}";
            
            // Create new fileContain by joining the line(s) in the array, line by line by using '\n'
            $fileContain = implode("\n", $csvFileLines);

            // rewrite the csv file by using fileContain and then save
            $csvFile = fopen(bucketLink, 'w');
            fwrite($csvFile, $fileContain);
            fclose($csvFile);
        } else {
            echo"csv file cannot be found";
            return 1;
        }
    }
    
    // get and display employee info
    function getEmployee() {
        if(!file_exists(bucketLink)) {
            echo "csv file cannot be found";

            exit();
        } else {
            // read the csv file and put all line into an array
            $csvFileLines = file(bucketLink, FILE_IGNORE_NEW_LINES);

            // loop line by line
            foreach($csvFileLines as $line) {
                // split each line by ','
                // we want to get ID which is employeeObject[0]
                $employeeObject = explode(",", $line);

                // $_POST['get'] is called when the edit icon of a specific row is clicked
                // $_POST['get'] return the employee ID of the selected row
                // return and display the employee data from the csv file that match $_POST['get']
                if ($employeeObject[0] == $_POST['get']) {
                    return $employeeObject;
                }
            }
        }
    }

    // this method will run when user click confirm save editing
    function updateEmployee() {
        if(!file_exists(bucketLink)) {
            echo "csv file cannot be found";
            exit();
        } else {
            // read the csv file and put all line into an array
            $csvFileLines = file(bucketLink, FILE_IGNORE_NEW_LINES);

            // search for the employee line that need to be updated
            for ($i = 0; $i < count($csvFileLines); $i++) {
                $employeeObject = explode(",", $csvFileLines[$i]);
                
                // find using ID
                if ($employeeObject[0] == $_POST['id']) {

                    // if ID match -> edit the content of the line of that employee
                    $csvFileLines[$i] = "{$_POST['id']},{$_POST['firstname']},{$_POST['lastname']},{$_POST['gender']},{$_POST['age']},{$_POST['address']},{$_POST['phone']}";
                    // recreate updated file content
                    $fileContain = implode("\n", $csvFileLines);
                    // rewrite and save
                    $csvFile = fopen(bucketLink, "w");
                    fwrite($csvFile, $fileContain);
                    fclose($csvFile);
                }
            }
        }
    }

    // delete method
    function deleteEmployee() {
        // check if file is ready to use
        if(!file_exists(bucketLink)) {
            echo"csv file cannot be found";
            exit();
        } else {
            // read the csv file and put all line into an array
            $csvFileLines = file(bucketLink, FILE_IGNORE_NEW_LINES);

            // search for the employee line that need to be deleted
            for ($i = 0; $i < count($csvFileLines); $i++) {
                $employeeObject = explode(",", $csvFileLines[$i]);

                // delete line when found
                if ($employeeObject[0] == $_POST['delete']) {
                    unset($csvFileLines[$i]);
                    $fileContain = implode("\n", $csvFileLines);
                    // rewrite and save
                    $csvFile = fopen(bucketLink, "w");
                    fwrite($csvFile, $fileContain);
                    fclose($csvFile);
                }
            }            
        }
    }

    // fetch data into data table
    function fetch() {
        if (!file_exists(bucketLink)) {
            echo "csv file cannot be found";
            exit();
        } else {
            // read the csv file and put all line into an array
            $csvFileLines = file(bucketLink, FILE_IGNORE_NEW_LINES);

            // split each line by ',' and get specific employee properties
			foreach($csvFileLines as $line) {
                $array = explode(",", $line); 
                $employeeID = $array[0];
                $firstName = $array[1];
                $lastName = $array[2];
                $gender = $array[3];
                $age = $array[4];
                $address = $array[5];
                $phone = $array[6];

                // echo the employee properties into table
                echo "<tr>";
                echo    "<td>".$employeeID."</td>";
                echo    "<td>".$firstName."</td>";
                echo    "<td>".$lastName."</td>";
                echo    "<td>".$gender."</td>";
                echo    "<td>".$age."</td>";
                echo    "<td>".$address."</td>";
                echo    "<td>".$phone."</td>";

                // /s3651589_A1/employee.php ---> XAMPP
                // /employee ---> deploy 
                echo "<form action='/' method='POST'>";
                echo "<td class='text-center'><button type='submit' class='btn btn-info' name='get' value='$employeeID'><i class='far fa-edit'></i></button></td>";
                echo "<td class='text-center'><button type='submit' class='btn btn-danger' name='delete' value='$employeeID'><i class='far fa-trash-alt'></i></button></td>";
                
                echo "</form>";
                echo "</tr>";
            }
        }
    }
?>


