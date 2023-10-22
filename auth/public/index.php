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
        <title>TIMECRAFT</title>
        <link rel="website icon" type="jpg" href="./aset/logo.jpg">
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="./style.css">
        <script src="script.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <nav class="bg-white sticky top-0 z-50">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
            <div x-data="{ sidebarOpen: false }">
              <!-- Tombol untuk membuka/menutup sidebar -->
              <button @click="sidebarOpen = !sidebarOpen" class="p-2">
                  <img class="h-8 w-auto" src="./aset/menu.png" alt="Your Company">
              </button>
          
              <!-- Sidebar -->
              <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="fixed left-0 top-0 h-full w-64 bg-white opacity-95 transition-transform duration-300 ease-in-out transform z-10 shadow-lg">
                  <!-- Isi sidebar Anda di sini -->
                  <ul class="p-4">
                      <li>
                        <div class="relative ml-3 group hover:shadow-lg" x-data="{ open: false }">
                           <button @click="open = !open" class="relative flex rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                               <span class="absolute -inset-1.5"></span>
                               <span class="sr-only">Open user menu</span>
                               <img class="h-10 w-10 rounded-full" src="./aset/user.png" alt="">
                               <a href="#" class="block px-4 py-2 text-lg text-black hover:shadow-lg font-bold"><?= current_user() ?></a>
                           </button>
                           <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                               <a href="#" class="block px-4 py-2 text-sm text-black hover:shadow-lg" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                               <!-- <a href="#" class="block px-4 py-2 text-sm text-stone-300" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a> -->
                               <a href="./logout.php" class="block px-4 py-2 text-sm text-black hover:shadow-lg" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                           </div>
                       </div></li>
                      <li><a href="./index.php" class="block px-4 py-2 text-sm text-black hover:shadow-lg mt-5">
                        <img src="./aset/list.png" alt="Logo" class="h-8 w-8 mr-2 inline-block">
                        Task List</a></li>
                      <li><a href="./lesson_plan.php" class="block px-4 py-2 text-sm text-black hover:shadow-lg mt-4">
                        <img src="./aset/book.png" alt="Logo" class="h-8 w-8 mr-2 inline-block">
                        Lesson Plan</a></li>
                      <!-- <li><a href="#" class="block px-4 py-2 text-sm text-black hover:shadow-lg mt-2">About Us</a></li>
                      <li><a href="#" class="block px-4 py-2 text-sm text-black hover:shadow-lg mt-2">Menu</a></li> -->
                  </ul>
              </div>
          </div>          
           <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>
            <div class="logoNiku hidden  sm:block items-center">
                <div class="logos flex flex-row items-center"> 
                    <a class="font-bold text-black p-3">TIME CRAFT</a>
                    <img class="h-8 w-auto" src="./aset/logo.jpg" alt="logo">
                </div>
            </div>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

    
            <!-- Profile dropdown -->
            <!-- <div class="relative ml-3 group" x-data="{ open: false }">
               <button @click="open = !open" class="relative flex rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                   <span class="absolute -inset-1.5"></span>
                   <span class="sr-only">Open user menu</span>
                   <img class="h-8 w-8 rounded-full" src="./aset/user.png" alt="">
               </button>
               <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                   <a href="#" class="block px-4 py-2 text-sm text-stone-300" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                   <a href="#" class="block px-4 py-2 text-sm text-stone-300" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                   <a href="#" class="block px-4 py-2 text-sm text-stone-300" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
               </div>
           </div> -->
           
           <!-- Sertakan script Tailwind CSS dan Alpine.js jika diperlukan -->
           <script src="path/to/your/tailwind.js"></script>
           <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>
          </div>
        </div>
      </div>
    </nav>


    <!--------------------------TASK LIST---------------------------->
    <div class="col-md-3"></div>
    <div class="col-md-6 well">
        <hr style="border-top:1px dotted #ccc;"/>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <center>
                <form method="POST" class="form-inline" action="add_query.php">
                    <input type="text" class="form-control" name="task" required placeholder="Task Name"/> <!-- Task Name input -->
                    <input type="text" class="form-control" name="detail" placeholder="Task Description"/> <!-- Task Description input -->
                    <button class="btn btn-primary form-control" name="add">Add Task</button>
                </form>
            </center>
    </div>
    <br /><br /><br />
    <table class="table">
    <thead>
        <tr>
            <th>Complete</th> <!-- New column -->
            <th>#</th>
            <th>Task</th>
            <th>Description</th>
            <th>Status</th>
            <th>Due Date</th> <!-- New column header -->
            <th>Action</th>
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
                    <a href="edit_query.php?task_id=<?php echo $fetch['task_id']?>" class="btn btn-info"><span class="glyphicon glyphicon-pencil">Edit</span></a> |
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

