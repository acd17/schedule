<?php
// Connect to your database (modify this according to your connection details)
$db = mysqli_connect("localhost", "root", "", "db_task");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task_id']) && isset($_POST['due_date'])) {
        $taskID = $_POST['task_id'];
        $dueDate = $_POST['due_date'];

        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($db, "UPDATE task SET due_date = ? WHERE task_id = ?");
        mysqli_stmt_bind_param($stmt, 'si', $dueDate, $taskID);

        if (mysqli_stmt_execute($stmt)) {
            echo 'Due date updated successfully';
        } else {
            echo 'Error: ' . mysqli_error($db);
        }
    } else {
        echo 'Invalid parameters';
    }
} else {
    echo 'Invalid request method';
}

// Close the database connection
mysqli_close($db);
?>
