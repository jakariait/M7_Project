-- Active: 1736774964041@@127.0.0.1@3306@task_api
CREATE TABLE tasks(
   id INT PRIMARY KEY AUTO_INCREMENT,
   title VARCHAR(100) NOT NULL UNIQUE,
   description TEXT,
   priority ENUM('low', 'medium', 'high') DEFAULT 'low',
   is_complete TINYINT NOT NULL DEFAULT 0 COMMENT '0: Not Completed, 1: Completed',
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO tasks (title, description, priority, is_complete) 
VALUES 
('Task 1', 'Description for Task 1', 'low', 0),
('Task 2', 'Description for Task 2', 'medium', 1),
('Task 3', 'Description for Task 3', 'high', 0),
('Task 4', 'Description for Task 4', 'medium', 0),
('Task 5', 'Description for Task 5', 'low', 1);

ALTER TABLE tasks CHANGE is_complete is_completed TINYINT NOT NULL DEFAULT 0;


SELECT * FROM tasks