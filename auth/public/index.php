<!-- INI INDEX UTAMA -->
<?php

require __DIR__ . '/../src/bootstrap.php';
require_login();
?>

<?php 
    // initialize errors variable
    $errors = "";

    // connect to database
    $db = mysqli_connect("localhost", "root", "", "db_task");

    // insert a quote if submit button is clicked
    if (isset($_POST['submit'])) {
        if (empty($_POST['task'])) {
            $errors = "You must fill in the task";
        } else {
            $task = $_POST['task'];
            // Set the default status to "Not Done"
            $status = "Not Done";
    
            // Connect to your database (modify this according to your connection details)
            $db = mysqli_connect("localhost", "root", "", "db_task");
    
            $stmt = mysqli_prepare($db, "INSERT INTO task (task, status) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, 'ss', $task, $status);
    
            if (mysqli_stmt_execute($stmt)) {
                header('location: index.php');
            } else {
                // Handle the error if the query execution fails
                echo "Error: " . mysqli_error($db);
            }
        }
    }

    // delete task
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
    
        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($db, "DELETE FROM tasks WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $id);

        if (mysqli_stmt_execute($stmt)) {
            header('location: index.php');
        } else {
            // Handle the error if the query execution fails
            echo "Error: " . mysqli_error($db);
        }
    }
?>

<?php view('header', ['title' => 'Dashboard']) ?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- <title>TIMECRAFT</title>
        <link rel="website icon" type="jpg" href="./aset/logo.jpg">
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
        <link rel="stylesheet" href="./style.css">
        <!-- <script src="script.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    </head>
    <body>
        
        
    
    <div class="containers">
        

    <!--------------------------TASK LIST---------------------------->
    <!-- <div class="col-md-3"></div> -->
    <div class="col-md-40 well">
        <div class="titleTask flex mt-3">
        <img src="./aset/list.png" alt="Logo" class="h-12 w-12  inline-block">
                        <p class="text-2xl items-center mt-2 ml-3 font-bold">Task List</p>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="formTask">
                <center>
                    <form method="POST" class="flex form-inline w-100" action="add_query.php">
                        <input type="text" class="form-control mr-3 h-10" name="task" required placeholder="Task Name"/> <!-- Task Name input -->
                        <input type="text" class="form-control h-10" name="detail" placeholder="Task Description"/> <!-- Task Description input -->
                        <button class="btn form-control" name="add">
                            <img class="h-6 w-6" src="./aset/pluss.png" alt="logo">
                        </button>
                    </form>
                </center>
            </div>
            
    </div>
    <br /><br /><br />
    <table class="table">
    <thead>
        <tr>
            <th style="padding-right: 50px; ">Complete</th> <!-- New column -->
            <th style="padding-right: 30px; ">#</th>
            <th style="padding-right: 50px; ">Task</th>
            <th style="padding-right: 60px; ">Description</th>
            <th style="padding-right: 70px; ">Status</th>
            <th style="padding-right: 70px; ">Due Date</th> <!-- New column header -->
            <th style="padding-right: 80px; ">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            require 'conn.php';

            // Retrieve and display tasks with "Not Done" status
            $query = $conn->query("SELECT * FROM `task` WHERE NOT `status` = 'Done' ORDER BY `task_id` ASC");
            $count = 1;

            while($fetch = $query->fetch_array()){
        ?>
        <tr>
            <td></td> <!-- Empty cell in the "Complete" column -->
            <td><?php echo $count++?></td>
            <td><?php echo $fetch['task']?></td>
            <td><?php echo $fetch['detail']?></td> 
            <td>
                <select name="status" id="status_<?php echo $fetch['task_id']; ?>" onchange="updateStatus(this)">
                    <option value="Not Yet Started" <?php echo ($fetch['status'] == 'Not Yet Started') ? 'selected' : ''; ?>>Not Yet Started</option>
                    <option value="On Progress" <?php echo ($fetch['status'] == 'On Progress') ? 'selected' : ''; ?>>On Progress</option>
                    <option value="Done" <?php echo ($fetch['status'] == 'Done') ? 'selected' : ''; ?>>Done</option>
                </select>
            </td>
            <td>
                <!-- Input element for due date -->
                <input type="date" name="due_date_<?php echo $fetch['task_id']; ?>" value="<?php echo $fetch['due_date']; ?>" onchange="updateDueDate(this)">
            </td>
            <td>
                <center>
                <?php
                    if ($fetch['status'] != "Done") {
                        echo '<a href="update_task.php?task_id=' . $fetch['task_id'] . '" onclick="return confirm(\'Are you sure you want to mark this task as done?\')" 
                                    class="btn btn-success"><span class="glyphicon glyphicon-check">Done</span></a> |';
                    }
                ?> 
                    <a href="edit_query.php?task_id=<?php echo $fetch['task_id']?>" class="edit btn btn-info"><span class="glyphicon glyphicon-pencil">Edit</span></a> |
                    <a href="delete_query.php?task_id=<?php echo $fetch['task_id']; ?>" onclick="return confirm('Are you sure you want to delete this task?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove">Delete</span></a>
                </center>
            </td>
        </tr>
            <?php
                }

                // Retrieve and display tasks with "Done" status
                $query = $conn->query("SELECT * FROM `task` WHERE `status` = 'Done' ORDER BY `task_id` ASC");

                while($fetch = $query->fetch_array()){
            ?>
            <tr>
                <td>✔</td> <!-- Display a checkmark in the "Complete" column -->
                <td><?php echo $count++?></td>
                <td><?php echo $fetch['task']?></td>
                <td><?php echo $fetch['detail']?></td> 
                <td>
                    <select name="status" id="status_<?php echo $fetch['task_id']; ?>" onchange="updateStatus(this)">
                        <option value="Not Yet Started" <?php echo ($fetch['status'] == 'Not Yet Started') ? 'selected' : ''; ?>>Not Yet Started</option>
                        <option value="On Progress" <?php echo ($fetch['status'] == 'On Progress') ? 'selected' : ''; ?>>On Progress</option>
                        <option value="Done" <?php echo ($fetch['status'] == 'Done') ? 'selected' : ''; ?>>Done</option>
                    </select>
                </td>
                <td><?php echo $fetch['due_date']?></td> 
                <td>
                    <center>
                        <a href="edit_query.php?task_id=<?php echo $fetch['task_id']?>" class="btn btn-info"><span class="glyphicon glyphicon-pencil">Edit</span></a> |
                        <a href="delete_query.php?task_id=<?php echo $fetch['task_id']; ?>" onclick="return confirm('Are you sure you want to delete this task?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove">Delete</span></a>
                    </center>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>


</div>
</div>
<script>
function updateStatus(select) {
    const taskID = select.id.split('_')[1];
    const status = select.value;

    if (status === 'Done' && !confirm('Are you sure you want to mark this task as Done?')) {
        // If the user clicks Cancel in the confirmation dialog, do nothing
        return;
    }

    // Send an AJAX request to update the task status
    $.ajax({
        type: 'POST',
        url: 'update_status.php',
        data: { task_id: taskID, status: status },
        success: function(response) {
            // Handle the response if needed
            console.log(response);

            // Reload the page after the status is updated
            location.reload();
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
}
</script>



</body>


<?php view('footer') ?>

