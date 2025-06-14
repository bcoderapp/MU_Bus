<?php
include 'includes/header.php';
include 'db.php';

// Handle addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_type'])) {
  $type = trim($_POST['type']);
  if (!empty($type)) {
    $stmt = $conn->prepare("INSERT INTO bus_types (name) VALUES (?)");
    $stmt->bind_param("s", $type);
    $stmt->execute();
  }
  header("Location: bus_types.php");
  exit;
}

// Handle edit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_type'])) {
  $id = intval($_POST['type_id']);
  $newType = trim($_POST['type_name']);
  if (!empty($newType)) {
    $stmt = $conn->prepare("UPDATE bus_types SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $newType, $id);
    $stmt->execute();
  }
  header("Location: bus_types.php");
  exit;
}

// Handle deletion
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM bus_types WHERE id = $id");
  header("Location: bus_types.php");
  exit;
}

// Fetch bus types
$result = $conn->query("SELECT * FROM bus_types ORDER BY name ASC");

// Check for edit mode
$edit_id = isset($_GET['edit']) ? intval($_GET['edit']) : null;
?>

<div class="container mt-4">
  <h3 class="text-primary mb-4">🚌 Manage Bus Types</h3>

  <!-- Add Bus Type Form -->
  <form method="POST" class="mb-4 d-flex gap-2">
    <input type="text" name="type" class="form-control" placeholder="Add New Bus Type" required>
    <button type="submit" name="add_type" class="btn btn-success">Add</button>
  </form>

  <!-- Bus Types Table -->
  <table class="table table-bordered align-middle">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Bus Type</th>
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
                <input type="hidden" name="type_id" value="<?= $row['id'] ?>">
                <input type="text" name="type_name" value="<?= htmlspecialchars($row['name']) ?>" class="form-control form-control-sm" required>
                <button type="submit" name="edit_type" class="btn btn-success btn-sm">✔</button>
                <a href="bus_types.php" class="btn btn-secondary btn-sm">✖</a>
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
