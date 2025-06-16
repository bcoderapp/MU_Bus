<?php 
include '../../includes/header.php';
include '../../includes/sidebar.php';
include '../../db.php';

// Validate and get schedule ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<div class='alert alert-danger'>Invalid Schedule ID!</div>";
  exit;
}

$id = intval($_GET['id']);

// Fetch existing schedule data
$stmt = $conn->prepare("SELECT * FROM bus_schedule WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
  echo "<div class='alert alert-warning'>Schedule not found!</div>";
  exit;
}

$row = $res->fetch_assoc();
$day = $row['day'];

// Fetch route and bus type options
$routes = $conn->query("SELECT name FROM routes ORDER BY name ASC");
$busTypes = $conn->query("SELECT name FROM bus_types ORDER BY name ASC");

// Handle update form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $route = trim($_POST['route']);
  $arrival = trim($_POST['arrival_time']);
  $departure = trim($_POST['departure_time']);
  $bus_no = trim($_POST['bus_no_type']);
  $driver = trim($_POST['driver_name']);
  $count = intval($_POST['no_of_bus']);
  $comment = trim($_POST['comment']);

  $update = $conn->prepare("UPDATE bus_schedule 
    SET route=?, arrival_time=?, departure_time=?, bus_no_type=?, driver_name=?, no_of_bus=?, comment=? 
    WHERE id=?");
  $update->bind_param("sssssssi", $route, $arrival, $departure, $bus_no, $driver, $count, $comment, $id);
  $update->execute();

  header("Location: ../bus_schedule.php?day=" . urlencode($day));
  exit;
}
?>

<style>
body {
  background: #f6f8fa;
  font-family: 'Segoe UI', Arial, sans-serif;
}

.container {
  max-width: 60%;
  margin: 40px auto 0 auto;
  padding: 32px 32px 24px 32px;
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 32px rgba(60,72,88,0.10);
}

h3 {
  color: #1a237e;
  margin-bottom: 32px;
  letter-spacing: 1px;
}

form {
  margin-top: 0;
}

.form-label {
  color: #283593;
  font-weight: 600;
  margin-bottom: 8px;
}

.form-control, .form-select {
  border-radius: 8px;
  border: 1px solid #c5cae9;
  padding: 10px 14px;
  font-size: 1rem;
  margin-bottom: 8px;
  background: #f3f6fb;
  transition: border-color 0.2s;
}

.form-control:focus, .form-select:focus {
  border-color: #536dfe;
  outline: none;
  background: #e8eaf6;
}

.btn-primary {
  background: linear-gradient(90deg, #536dfe 0%, #1a237e 100%);
  border: none;
  color: #fff;
  font-weight: 600;
  border-radius: 8px;
  padding: 10px 28px;
  margin-right: 10px;
  box-shadow: 0 2px 8px rgba(83,109,254,0.08);
  transition: background 0.2s;
}

.btn-primary:hover {
  background: linear-gradient(90deg, #1a237e 0%, #536dfe 100%);
}

.btn-secondary {
  background: #e3e6fd;
  color: #1a237e;
  border: none;
  border-radius: 8px;
  padding: 10px 24px;
  font-weight: 500;
  margin-left: 8px;
}

.btn-outline-primary {
  border: 1.5px solid #536dfe;
  color: #536dfe;
  background: #fff;
  border-radius: 8px;
  font-weight: 500;
  padding: 8px 18px;
  margin-left: 8px;
  transition: background 0.2s, color 0.2s;
}

.btn-outline-primary:hover {
  background: #536dfe;
  color: #fff;
}

.mb-3, .mb-4 {
  margin-bottom: 1.5rem !important;
}

.p-4 {
  padding: 2rem !important;
}

.bg-light {
  background: #f3f6fb !important;
}

.shadow {
  box-shadow: 0 2px 16px rgba(60,72,88,0.10) !important;
}

.alert {
  border-radius: 8px;
  padding: 14px 20px;
  margin-bottom: 24px;
  font-size: 1rem;
}

.alert-danger {
  background: #ffebee;
  color: #c62828;
  border: 1px solid #ffcdd2;
}

.alert-warning {
  background: #fffde7;
  color: #f9a825;
  border: 1px solid #ffe082;
}
</style>


<div class="container">
  <h3 class="text-primary fw-bold mb-4">✏️ Edit Schedule for <?= strtoupper(htmlspecialchars($day)) ?></h3>

  <form method="POST" class="p-4 bg-light rounded shadow">

    <!-- Route Dropdown -->
    <div class="mb-3">
      <label class="form-label">Route</label>
      <div class="d-flex gap-2">
        <select name="route" class="form-select" required>
          <option value="">Select a route</option>
          <?php while ($r = $routes->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($r['name']) ?>" 
              <?= $r['name'] === $row['route'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($r['name']) ?>
            </option>
          <?php endwhile; ?>
        </select>
        <a href="routes.php" class="btn btn-outline-primary">Manage</a>
      </div>
    </div>

    <!-- Arrival and Departure Times -->
    <div class="row mb-3">
      <div class="col">
        <label class="form-label">Arrival Time</label>
        <input type="time" name="arrival_time" class="form-control" 
               value="<?= htmlspecialchars($row['arrival_time']) ?>" required>
      </div>
      <div class="col">
        <label class="form-label">Departure Time</label>
        <input type="time" name="departure_time" class="form-control" 
               value="<?= htmlspecialchars($row['departure_time']) ?>" required>
      </div>
    </div>

    <!-- Bus No / Type Dropdown -->
    <div class="mb-3">
      <label class="form-label">Bus No/Type</label>
      <div class="d-flex gap-2">
        <select name="bus_no_type" class="form-select" required>
          <option value="">Select bus type</option>
          <?php while ($b = $busTypes->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($b['name']) ?>" 
              <?= $b['name'] === $row['bus_no_type'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($b['name']) ?>
            </option>
          <?php endwhile; ?>
        </select>
        <a href="bus_types.php" class="btn btn-outline-primary">Manage</a>
      </div>
    </div>

    <!-- Driver Name -->
    <div class="mb-3">
      <label class="form-label">Driver Name</label>
      <input type="text" name="driver_name" class="form-control" 
             value="<?= htmlspecialchars($row['driver_name']) ?>" placeholder="Optional">
    </div>

    <!-- No. of Buses -->
    <div class="mb-3">
      <label class="form-label">No. of Buses</label>
      <input type="number" name="no_of_bus" class="form-control" min="1" 
             value="<?= htmlspecialchars($row['no_of_bus']) ?>" placeholder="Optional">
    </div>

    <!-- Comment -->
    <div class="mb-3">
      <label class="form-label">Comment</label>
      <textarea name="comment" class="form-control" rows="3"><?= htmlspecialchars($row['comment']) ?></textarea>
    </div>

    <!-- Action Buttons -->
    <button class="btn btn-primary">Update Schedule</button>
    <a href="../bus_schedule.php?day=<?= urlencode($day) ?>" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<?php include '../../includes/footer.php'; ?>
