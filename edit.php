<?php
require_once __DIR__ . '/functions.php';

$id = (int)($_GET['id'] ?? 0);
$task = $id ? get_task($id) : null;

if (!$task) {
    header("Location: index.php");
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '') {
        $errors[] = "Le titre est obligatoire.";
    } else {
        update_task($id, $title, $description);
        header("Location: index.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Modifier tâche</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h1>Modifier la tâche #<?php echo $task['id']; ?></h1>
  <?php if ($errors): ?>
    <div class="alert alert-danger"><?php echo implode('<br>', $errors); ?></div>
  <?php endif; ?>
  <form method="post" class="card card-body">
    <div class="mb-3">
      <label class="form-label">Titre *</label>
      <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($task['title']); ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control"><?php echo htmlspecialchars($task['description']); ?></textarea>
    </div>
    <button class="btn btn-primary">Enregistrer</button>
    <a href="index.php" class="btn btn-secondary">Annuler</a>
  </form>
</div>
</body>
</html>
