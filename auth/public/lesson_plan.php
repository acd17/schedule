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
    <!-- <div class="containers"> -->
        
        <!-- <nav class="bg-white sticky top-0 z-50 float-left">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
            <div x-data="{ sidebarOpen: false }">
              
              <button @click="sidebarOpen = !sidebarOpen" class="menu p-2 flex rounded-full">
                  <img class="h-8 w-auto" src="./aset/menu.png" alt="Your Company">
              </button>
          
              
              <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="fixed left-0 top-0 h-full w-64 bg-white opacity-95 transition-transform duration-300 ease-in-out transform z-10 shadow-lg">
                  
                  <ul class="p-4 w-64">
                      <li>
                        <div class="relative p-3 group" x-data="{ open: false }">
                           <button @click="open = !open" class="relative flex rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                               <span class="absolute -inset-1.5"></span>
                               <span class="sr-only">Open user menu</span>
                               <img class="users h-10 w-10 rounded-full" src="./aset/user.png" alt="">
                               <a href="#" class="block px-4 py-2 text-lg text-black hover:shadow-lg font-bold"><?= current_user() ?></a>
                           </button>
                           <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                               <a href="#" class="block px-4 py-2 text-sm text-black hover:shadow-lg" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                               
                               <a href="./logout.php" class="block px-4 py-2 text-sm text-black hover:shadow-lg" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                           </div>
                       </div></li>
                      <li><a href="./index.php" class="block px-4 py-2 text-sm text-black hover:shadow-lg mt-5">
                        <img src="./aset/list.png" alt="Logo" class="h-8 w-8 mr-2 inline-block">
                        Task List</a></li>
                      <li><a href="./lesson_plan.php" class="block px-4 py-2 text-sm text-black hover:shadow-lg mt-4">
                        <img src="./aset/book.png" alt="Logo" class="h-8 w-8 mr-2 inline-block">
                        Lesson Plan</a></li>
                      
                  </ul>
              </div>
          </div>          
           <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>
            <div class="logoNiku hidden sm:block items-end">
                <div class="logos flex flex-row items-center"> 
                    <a class="font-bold text-black p-2">TIMECRAFT</a>
                    <img class="h-8 w-auto" src="./aset/logo.jpg" alt="logo">
                </div>
            </div>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
           <script src="path/to/your/tailwind.js"></script>
           <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>
          </div>
        </div>
      </div>
    </nav> -->
    
    <!-- ---------------------------------------------COPASAN YG INDEX.PHP------------------------------------------------ -->
    
    <div class="titleTask flex mt-3">
        <img src="./aset/book.png" alt="Logo" class="h-12 w-12  inline-block">
                        <p class="text-2xl items-center mt-2 ml-3 font-bold">Lesson Plan</p>
        </div>



    <!-- ----------TABLE--------- -->
    
        <?php
            // Connect to your database (modify this according to your connection details)
            $db = mysqli_connect("localhost", "root", "", "db_task");

            // Define the task statuses
            $statuses = array("Not Yet Started", "On Progress", "Done");

            // Add this line before your table definition
            echo "<table class='table_status' border='1'><tr class='upTable'>";

            foreach ($statuses as $status) {
                // Set a class for each column based on the status
                $class = strtolower(str_replace(' ', '-', $status)); // Convert status to a valid class name
                echo "<th class='$class'>$status</th>";
            }
            echo "</tr>";

            // Determine the maximum number of tasks in any status
            $maxTasks = 0;
            foreach ($statuses as $status) {
                $stmt = mysqli_prepare($db, "SELECT COUNT(*) as task_count FROM task WHERE status = ?");
                mysqli_stmt_bind_param($stmt, 's', $status);

                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);
                    $taskCount = $row['task_count'];
                    $maxTasks = max($maxTasks, $taskCount);
                }
            }

            // Create rows for each task, including the status cell
            for ($i = 0; $i < $maxTasks; $i++) {
                echo "<tr class='downTable'>";

                foreach ($statuses as $status) {
                    $stmt = mysqli_prepare($db, "SELECT task, due_date FROM task WHERE status = ? LIMIT 1 OFFSET ?");
                    mysqli_stmt_bind_param($stmt, 'si', $status, $i);
                    $class = strtolower(str_replace(' ', '-', $status)); // Convert status to a valid class name

                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if ($row = mysqli_fetch_assoc($result)) {
                            $taskName = $row['task'];
                            $dueDate = $row['due_date'];
                            echo "<td class='$class'>$taskName<br>$dueDate</td>";
                        } else {
                            echo "<td></td>";
                        }
                    } else {
                        echo "Error: " . mysqli_error($db);
                    }
                }
                echo "</tr>";
            }

            echo "</table>";

            // Close the database connection
            mysqli_close($db);
        ?>
    <!-- </div> -->


</body>


<?php view('footer') ?>

