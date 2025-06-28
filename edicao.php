<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = ?');
$stmt->execute([$id]);
$task = $stmt->fetch();

if (!$task) {
    echo "Tarefa não encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="container">
    <h1>Editar Tarefa</h1>

    <form action="acoes.php" method="POST" class="task-form">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="task_id" value="<?= htmlspecialchars($task['id']) ?>">

        <input 
            type="text" 
            name="description" 
            class="task-input" 
            placeholder="Digite a tarefa..." 
            required
            value="<?= htmlspecialchars($task['description']) ?>"
        >

        <select name="priority" class="task-input" required>
            <option value="1" <?= $task['priority'] == 1 ? 'selected' : '' ?>>Baixa</option>
            <option value="2" <?= $task['priority'] == 2 ? 'selected' : '' ?>>Média</option>
            <option value="3" <?= $task['priority'] == 3 ? 'selected' : '' ?>>Alta</option>
        </select>

        <button type="submit" class="btn">Salvar Alterações</button>
        <a href="index.php" class="btn" style="background:#ccc; color:#333; margin-left:10px; text-decoration:none; padding:12px 20px; border-radius:5px;">Cancelar</a>
    </form>
</div>
</body>
</html>