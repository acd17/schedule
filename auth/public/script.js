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