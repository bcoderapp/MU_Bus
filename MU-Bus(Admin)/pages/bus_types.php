<?php
include '../includes/header.php';
include '../includes/sidebar.php';
include '../db.php';

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

<style>
body {
    background: linear-gradient(135deg, #e9f2ff 0%, #f4f6fa 100%);
    min-height: 100vh;
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
}
.container {
    width: 100%;
    max-width: calc(100vw - 260px);
    margin-left: 260px;
    margin-right: 0;
    padding: 2.5rem 2.5rem 1.5rem 2.5rem;
    box-sizing: border-box;
}
@media (max-width: 991.98px) {
    .container {
        max-width: 100vw;
        margin-left: 0;
        padding: 1.2rem 0.5rem;
    }
}
.card {
    border-radius: 1rem;
    border: none;
    box-shadow: 0 2px 12px 0 rgba(37,99,235,0.07);
    background: #fff;
}
.card-header {
    background: #fff;
    border-bottom: 1px solid #e0e7ef;
    border-radius: 1rem 1rem 0 0;
}
.card-footer {
    background: #fff;
    border-top: 1px solid #e0e7ef;
    border-radius: 0 0 1rem 1rem;
}
h3 {
    font-size: 2rem;
    font-weight: 700;
    letter-spacing: 0.01em;
}
.table thead th, .table-light th {
    background-color: #2563eb !important;
    color: #fff !important;
    border-color: #e0e7ef;
}
.table th, .table td {
    font-size: 1rem;
    vertical-align: middle;
}
.btn, .btn-action, .add-btn {
    font-size: 1rem;
}
.btn-success {
    width: 20%;
    border: none;
}
.btn-success:hover, .btn-success:focus {
    background: #16a34a;
}
.btn-primary {
    background: #2563eb;
    border: none;
}
.btn-primary:hover, .btn-primary:focus {
    background: #1d4ed8;
}
.btn-danger {
    background: #ef4444;
    border: none;
}
.btn-danger:hover, .btn-danger:focus {
    background: #dc2626;
}
.btn-secondary {
    background: #64748b;
    border: none;
}
.btn-secondary:hover, .btn-secondary:focus {
    background: #475569;
}
.form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 0.15rem rgba(37,99,235,0.15);
}
input[type="text"].form-control {
    border-radius: 0.5rem;
}
.table tr {
    transition: background 0.15s;
}
.table tr:hover {
    background: #f1f5fd;
}
@media (max-width: 991.98px) {
    body {
        font-size: 0.98rem;
    }
    .table th, .table td {
        font-size: 0.95rem;
    }
    h3 {
        font-size: 1.5rem;
    }
}
</style>

<div class="container mt-4">
  <div class="card shadow-sm mb-4">
    <div class="card-header pb-2">
      <h3 class="text-primary mb-0">🚌 Manage Bus No. or Types</h3>
    </div>
    <div class="card-body">
      <!-- Add Bus Type Form -->
      <form method="POST" class="mb-4 d-flex gap-2">
        <input type="text" name="type" class="form-control" placeholder="Add New Bus Type" required>
        <button type="submit" name="add_type" class="btn btn-success">Add New Bus</button>
      </form>

      <!-- Bus Types Table -->
      <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
          <thead class="table-dark">
            <tr>
              <th style="width: 60px;">#</th>
              <th>Bus Type or Bus No.</th>
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
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>