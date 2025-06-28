<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $description = $_POST['description'] ?? '';
        $priority = $_POST['priority'] ?? 1;
$_SESSION['feedback_message'] = "Tarefa criada com sucesso!";

        if (!empty($description)) {
            $stmt = $pdo->prepare('INSERT INTO tasks(description, priority) VALUES (?, ?)');
            $stmt->execute([$description, $priority]);
        }
    }

    elseif ($action === 'delete') {
        $id = $_POST['task_id'] ?? 0;
        if ($id > 0) {
            $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
            $stmt->execute([$id]);
            $_SESSION['feedback_message'] = "Tarefa removida com sucesso!";}

        }
        
         elseif ($action === 'update') {
                $id = $_POST['task_id'] ?? 0;
                $description = $_POST['description'] ?? '';
                $priority = $_POST['priority'] ?? 1;
                $_SESSION['feedback_message'] = "Tarefa atualizada com sucesso!";}
        
                if ($id > 0 && !empty($description)) {
                    $stmt = $pdo->prepare('UPDATE tasks SET description = ?, priority = ? WHERE id = ?');
                    $stmt->execute([$description, $priority, $id]);
                          }
    }

header('Location: index.php');
exit();