<?php
require_once __DIR__ . '/functions.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '') {
        $errors[] = "Le titre est obligatoire.";
    } else {
        add_task($title, $description);
        header("Location: index.php");
        exit;
    }
}

$tasks = get_tasks();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>To-Do List (PHP/MySQL)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h1 class="mb-4">📝 To-Do List</h1>

  <div class="card mb-4">
    <div class="card-header">Ajouter une tâche</div>
    <div class="card-body">
      <?php if ($errors): ?>
        <div class="alert alert-danger"><?php echo implode('<br>', $errors); ?></div>
      <?php endif; ?>
      <form method="post">
        <input type="hidden" name="action" value="create">
        <div class="mb-3">
          <label class="form-label">Titre *</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="2"></textarea>
        </div>
        <button class="btn btn-primary">Ajouter</button>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Liste des tâches</div>
    <div class="card-body p-0">
      <table class="table table-striped mb-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Statut</th>
            <th>Date</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tasks as $t): ?>
            <tr>
              <td><?php echo $t['id']; ?></td>
              <td><?php echo htmlspecialchars($t['title']); ?></td>
              <td><?php echo htmlspecialchars($t['description'] ?? ''); ?></td>
              <td>
                <?php if ($t['is_done']): ?>
                  <span class="badge bg-success">✔ Terminé</span>
                <?php else: ?>
                  <span class="badge bg-secondary">⏳ En cours</span>
                <?php endif; ?>
              </td>
              <td><?php echo $t['created_at']; ?></td>
              <td class="text-end">
                <form action="toggle.php" method="post" class="d-inline">
                  <input type="hidden" name="id" value="<?php echo $t['id']; ?>">
                  <button class="btn btn-sm btn-outline-warning">
                    <?php echo $t['is_done'] ? 'Marquer en cours' : 'Marquer terminé'; ?>
                  </button>
                </form>
                <a href="edit.php?id=<?php echo $t['id']; ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
                <form action="delete.php" method="post" class="d-inline" onsubmit="return confirm('Supprimer cette tâche ?');">
                  <input type="hidden" name="id" value="<?php echo $t['id']; ?>">
                  <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php if (count($tasks) === 0): ?>
            <tr><td colspan="6" class="text-center text-muted py-3">Aucune tâche</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
