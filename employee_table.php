<div class="employee-table">
    <h4 class="form-header">Employee List</h4>
    <table id="employee_table" class="table table-bordered">
        <thead>
            <tr class="table-header">
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Age</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col" class='text-center'>Edit</th>
                <th scope="col" class='text-center'>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            fetch();
            ?>
        </tbody>
    </table>
</div>