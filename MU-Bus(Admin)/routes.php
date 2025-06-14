<?php
include 'includes/header.php';
include 'db.php';

// Handle addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_route'])) {
  $route = trim($_POST['route']);
  if (!empty($route)) {
    $stmt = $conn->prepare("INSERT INTO routes (name) VALUES (?)");
    $stmt->bind_param("s", $route);
    $stmt->execute();
  }
  header("Location: routes.php");
  exit;
}

// Handle edit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_route'])) {
  $id = intval($_POST['route_id']);
  $newName = trim($_POST['route_name']);
  if (!empty($newName)) {
    $stmt = $conn->prepare("UPDATE routes SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $newName, $id);
    $stmt->execute();
  }
  header("Location: routes.php");
  exit;
}

// Handle deletion
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM routes WHERE id = $id");
  header("Location: routes.php");
  exit;
}

// Fetch routes
$result = $conn->query("SELECT * FROM routes ORDER BY name ASC");

// Edit mode check
$edit_id = isset($_GET['edit']) ? intval($_GET['edit']) : null;
?>

<div class="container mt-4">
  <h3 class="text-primary mb-4">🛣️ Manage Routes</h3>

  <!-- Add Route Form -->
  <form method="POST" class="mb-4 d-flex gap-2">
    <input type="text" name="route" class="form-control" placeholder="Add New Route" required>
    <button type="submit" name="add_route" class="btn btn-success">Add</button>
  </form>

  <!-- Routes Table -->
  <table class="table table-bordered align-middle">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Route Name</th>
        <th style="width: 120px;">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $i++ ?></td>

          <td>
            <?php if ($edit_id === intval($row['id'])): ?>
              <!-- Edit form -->
              <form method="POST" class="d-flex gap-2">
                <input type="hidden" name="route_id" value="<?= $row['id'] ?>">
                <input type="text" name="route_name" value="<?= htmlspecialchars($row['name']) ?>" class="form-control form-control-sm" required>
                <button type="submit" name="edit_route" class="btn btn-success btn-sm">✔</button>
                <a href="routes.php" class="btn btn-secondary btn-sm">✖</a>
              </form>
            <?php else: ?>
              <?= htmlspecialchars($row['name']) ?>
            <?php endif; ?>
          </td>

          <td>
            <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-primary" title="Edit">
              <i class="bi bi-pencil-square"></i>
            </a>
            <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" title="Delete">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
