<?php 
include 'includes/header.php'; 
include 'db.php'; 

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

  header("Location: dashboard.php?day=" . urlencode($day));
  exit;
}
?>

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
    <a href="dashboard.php?day=<?= urlencode($day) ?>" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
