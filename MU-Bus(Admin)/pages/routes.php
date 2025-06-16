<?php
include '../includes/header.php';
include '../includes/sidebar.php';
include '../db.php';
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

  .table thead th,
  .table-light th {
    background-color: #2563eb !important;
    color: #fff !important;
    border-color: #e0e7ef;
  }

  body {
    font-size: 1.05rem;
  }

  .table th,
  .table td {
    font-size: 1rem;
  }

  .table-title {
    font-size: 1.15rem;
    font-weight: 600;
  }

  h3 {
    font-size: 2.1rem;
  }

  .btn,
  .btn-action,
  .add-btn {
    font-size: 1rem;
  }

  .btn-success {
    width: 20%;
  }

  .btn-success,
  .btn-primary,
  .btn-danger,
  .btn-secondary {
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
  }

  .btn-success:hover,
  .btn-success:focus {
    background: #198754 !important;
    color: #fff !important;
    box-shadow: 0 2px 8px #19875433;
  }

  .btn-primary:hover,
  .btn-primary:focus {
    background: #1746a2 !important;
    color: #fff !important;
    box-shadow: 0 2px 8px #2563eb33;
  }

  .btn-danger:hover,
  .btn-danger:focus {
    background: #c82333 !important;
    color: #fff !important;
    box-shadow: 0 2px 8px #dc354533;
  }

  .btn-secondary:hover,
  .btn-secondary:focus {
    background: #6c757d !important;
    color: #fff !important;
  }

  .card {
    border-radius: 1rem;
    box-shadow: 0 2px 16px #2563eb0d, 0 1.5px 4px #0001;
    border: none;
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

  input[type="text"].form-control,
  .form-control-sm {
    border-radius: 0.5rem;
    border: 1px solid #e0e7ef;
    transition: border 0.2s;
  }

  input[type="text"].form-control:focus,
  .form-control-sm:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px #2563eb22;
  }

  @media (max-width: 991.98px) {
    body {
      font-size: 0.98rem;
    }

    .table th,
    .table td {
      font-size: 0.95rem;
    }

    h3 {
      font-size: 1.5rem;
    }
  }
</style>

<?php
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
  <div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-0 pb-0">
      <h3 class="text-primary mb-2" style="letter-spacing:0.02em;">🛣️ Manage Routes</h3>
    </div>
    <div class="card-body">
      <!-- Add Route Form -->
      <form method="POST" class="mb-4 d-flex gap-2">
        <input type="text" name="route" class="form-control" placeholder="Add New Route" required>
        <button type="submit" name="add_route" class="btn btn-success">Add New Route</button>
      </form>

      <!-- Routes Table -->
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Route Name</th>
              <th style="width: 120px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $i++ ?></td>
                <td>
                  <?php if ($edit_id === intval($row['id'])): ?>
                    <!-- Edit form -->
                    <form method="POST" class="d-flex gap-2">
                      <input type="hidden" name="route_id" value="<?= $row['id'] ?>">
                      <input type="text" name="route_name" value="<?= htmlspecialchars($row['name']) ?>"
                        class="form-control form-control-sm" required>
                      <button type="submit" name="edit_route" class="btn btn-success btn-sm">✔</button>
                      <a href="routes.php" class="btn btn-secondary btn-sm">✖</a>
                    </form>
                  <?php else: ?>
                    <?= htmlspecialchars($row['name']) ?>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-primary me-1" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')"
                    class="btn btn-sm btn-danger" title="Delete">
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