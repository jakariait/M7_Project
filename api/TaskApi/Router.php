<?php
namespace Api\TaskApi;

class Router
{
    private $task;

    public function __construct($task)
    {
        $this->task = $task;
    }
    // Checking Recquest Type
    public function handleRecquest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path   = isset($_GET['id']) ? intval($_GET['id']) : null;

        switch ($method) {
            case "GET":
                $this->handleGetRecquest($path);
                break;
            case "POST":
                $this->handlePostRecquest();
                break;
            case "PUT":
                $this->handlePutRecquest($path);
                break;
            case "DELETE":
                $this->handleDeleteRecquest($path);
                break;
            default:
                http_response_code(404);
                echo json_encode(["error" => "Method Not Allowed"]);
        }
    }

    // Handle GET Recquest
    private function handleGetRecquest($id)
    {
        if ($id) {
            // Get single Task by ID
            $task = $this->task->getTask($id);

            if ($task) {
                echo json_encode($task);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Task not found."]);
            }
        } else {
            // Fetch All Tasks
            $tasks = $this->task->getAllTasks();

            if (empty($tasks)) {
                http_response_code(404);
                echo json_encode(["error" => "No tasks found."]);
            } else {
                echo json_encode($tasks);
            }
        }
    }

    // Handle POST Recquest
    private function handlePostRecquest()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        // Validate Title
        if (! isset($data['title']) || trim($data['title']) === "") {
            http_response_code(404);
            echo json_encode(["error" => "Title is recquired."]);
            return;
        }

        // Priority Validation
        $validPriorities = ["low", "medium", "high"];

        if (isset($data['priority']) && ! in_array($data['priority'], $validPriorities)) {
            http_response_code(404);
            echo json_encode(["error" => "Invalid priority. Valid priorities are; low, medium, high."]);
            return;
        }
        // Create Task
        $response = $this->task->createTask($data);
        echo json_encode($response);

    }

    // Handle PUT Recquest
    private function handlePutRecquest($id)
    {
        if (! $id) {
            echo json_encode(["error" => "Task ID is recquired."]);
            http_response_code(400);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($this->task->updateTask($id, $data));
    }

    // Handle delete Recquest
    private function handleDeleteRecquest($id)
    {
        if (! $id) {
            echo json_encode(["error" => "Task ID is recquired."]);
            http_response_code(400);
            return;
        }

        echo json_encode($this->task->deleteTask($id));
    }
}
