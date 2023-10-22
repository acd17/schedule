<?php
	require_once 'conn.php';
	if(ISSET($_POST['add'])){
		if(!empty($_POST['task'])){
			$task = $_POST['task'];
			$detail = isset($_POST['detail']) ? $_POST['detail'] : ''; // Get the task description

			// Use prepared statements to prevent SQL injection
			$stmt = $conn->prepare("INSERT INTO `task` (`task`, `detail`, `status`) VALUES(?, ?, '')");
			$stmt->bind_param("ss", $task, $detail);

			if ($stmt->execute()) {
				header('location:index.php');
			} else {
				// Handle the error if the query execution fails
				echo "Error: " . $stmt->error;
			}
		}
	}
?>
