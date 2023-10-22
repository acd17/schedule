<?php
    require_once 'conn.php';

    if (isset($_GET['task_id'])) {
        $task_id = $_GET['task_id'];

        // Retrieve the task details from the database
        $result = $conn->query("SELECT * FROM `task` WHERE `task_id` = $task_id");
        if ($result) {
            $row = $result->fetch_assoc();
            $task = $row['task'];
            $detail = $row['detail']; // Get the task description
        } else {
            die("Error: Unable to retrieve task details");
        }
    } else {
        die("Error: Task ID not provided");
    }

    if (isset($_POST['update'])) {
        // Get the updated task and description from the form
        $updated_task = $_POST['task'];
        $updated_detail = $_POST['detail'];

        // Update the task and description in the database
        $conn->query("UPDATE `task` SET `task` = '$updated_task', `detail` = '$updated_detail' WHERE `task_id` = $task_id") or die(mysqli_errno($conn));

        // Redirect back to the index page
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
    <h2>Edit Task</h2>
    <form method="POST">
        <label for="task">Task:</label>
        <input type="text" name="task" value="<?php echo $task; ?>" required>
        <br>
        <label for="detail">Description:</label>
        <textarea name="detail" rows="4" required><?php echo $detail; ?></textarea>
        <br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
