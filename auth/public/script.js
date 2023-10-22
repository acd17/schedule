(function(){
    $('#msbo').on('click', function(){
      $('body').toggleClass('msb-x');
    });
  }());


/*---------------FUNCTION ADD & DELETE TASK--------------*/
  function addTask() {
    var newTaskText = document.getElementById("new-task").value;
    if (newTaskText) {
        var taskList = document.getElementById("task-list");
        var newTask = document.createElement("li");
        newTask.innerHTML = `
            <input type="checkbox' class='task-checkbox'>
            <span>${newTaskText}</span>
            <button class='delete-task' onclick='deleteTask(this)'>Delete</button>
        `;
        taskList.appendChild(newTask);
        document.getElementById("new-task").value = "";
    }
  }

  function deleteTask(button) {
    button.parentElement.remove();
  }


/*-------------------------FUNCTION UPDATE STATUS-------------------------*/

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


/*-------------------------FUNCTION UPDATE DUE DATE-------------------------*/
function updateDueDate(input) {
  const taskID = input.name.split('_')[2];
  const dueDate = input.value;

  // Send an AJAX request to update the due date in the database
  $.ajax({
      type: 'POST',
      url: 'update_due_date.php',
      data: { task_id: taskID, due_date: dueDate },
      success: function(response) {
          // Handle the response if needed
          console.log(response);
      },
      error: function(error) {
          console.log('Error:', error);
      }
  });
}