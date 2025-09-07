<?php
require_once __DIR__ . '/config.php';

function get_tasks() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
    return $stmt->fetchAll();
}

function get_task($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function add_task($title, $description) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
    return $stmt->execute([$title, $description]);
}

function update_task($id, $title, $description) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ? WHERE id = ?");
    return $stmt->execute([$title, $description, $id]);
}

function toggle_task($id) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE tasks SET is_done = 1 - is_done WHERE id = ?");
    return $stmt->execute([$id]);
}

function delete_task($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    return $stmt->execute([$id]);
}
