/*
    Run ini di mySQL XAMPP kalian dulu yaa! :DD
*/

mysql -u root

CREATE DATABASE auth;

use auth;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(25) NOT NULL UNIQUE,
    email VARCHAR(320) NOT NULL UNIQUE,
    password VARCHAR(256) NOT NULL,
    is_admin TINYINT(1) not null default 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE DATABASE db_task;

use db_task;

CREATE TABLE task (
  task_id int(11) NOT NULL,
  task varchar(150) NOT NULL,
  status varchar(150) NOT NULL,
  detail varchar(255),
  date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  date_modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  due_date DATE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
INSERT INTO task (task_id, task, status) VALUES
(1, 'Check Errors', 'Done'),
(4, 'Remove Bugs', ''),
(5, 'Need Improvements', '');
 
ALTER TABLE task
  ADD PRIMARY KEY (task_id);
 
ALTER TABLE task
  MODIFY task_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;