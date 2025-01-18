<?php

use Api\TaskApi\Router;
use Api\TaskApi\Task;
use Config\Database;

require_once "./vendor/autoload.php";
header("Content-Type: application/json");

// Database Intialization
$db     = new Database();
$conn   = $db->getConnection();
$task   = new Task($conn);
$router = new Router($task);

// Handle Recquest
$router->handleRecquest();

$conn->close();
