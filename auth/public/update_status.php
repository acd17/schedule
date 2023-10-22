<?php
if (isset($_POST['task_id']) && isset($_POST['status'])) {
    $taskID = $_POST['task_id'];
    $newStatus = $_POST['status'];

    // Connect to your database (modify this according to your connection details)
    $db = mysqli_connect("localhost", "root", "", "db_task");

    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($db, "UPDATE task SET status = ? WHERE task_id = ?");
    mysqli_stmt_bind_param($stmt, 'si', $newStatus, $taskID);

    if (mysqli_stmt_execute($stmt)) {
        echo 'Status updated successfully.';
    } else {
        echo 'Error: ' . mysqli_error($db);
    }
} else {
    echo 'Invalid request.';
}
?>
