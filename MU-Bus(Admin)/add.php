<?php 
include 'includes/header.php'; 
include 'db.php'; 

// Default day selection fallback
$day = $_GET['day'] ?? 'Sunday';

// Fetch route and bus type lists from database
$routes = $conn->query("SELECT name FROM routes ORDER BY name ASC");
$busTypes = $conn->query("SELECT name FROM bus_types ORDER BY name ASC");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $route = trim($_POST['route']);
  $arrival = trim($_POST['arrival_time']);
  $departure = trim($_POST['departure_time']);
  $bus_no = trim($_POST['bus_no_type']);
  $driver = trim($_POST['driver_name']);
  $count = intval($_POST['no_of_bus']);
  $comment = trim($_POST['comment']);

  // Prepare SQL insert query
  $stmt = $conn->prepare("INSERT INTO bus_schedule 
    (day, route, arrival_time, departure_time, bus_no_type, driver_name, no_of_bus, comment) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssis", $day, $route, $arrival, $departure, $bus_no, $driver, $count, $comment);
  $stmt->execute();

  // Redirect to dashboard after successful insertion
  header("Location: dashboard.php?day=$day");
  exit();
}
?>

<div class="container">
  <h3 class="text-primary fw-bold mb-4">+ Add New Schedule for <?= strtoupper($day) ?></h3>
  
  <form method="POST" class="p-4 bg-light rounded shadow">

    <!-- Hidden Day Field -->
    <input type="hidden" name="day" value="<?= $day ?>">

    <!-- Route Dropdown -->
    <div class="mb-3">
      <label class="form-label">Route</label>
      <div class="d-flex gap-2">
        <select name="route" class="form-select" required>
          <option value="">Select a route</option>
          <?php while ($r = $routes->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($r['name']) ?>"><?= htmlspecialchars($r['name']) ?></option>
          <?php endwhile; ?>
        </select>
        <a href="routes.php" class="btn btn-outline-primary">Manage</a>
      </div>
    </div>

    <!-- Arrival & Departure Times -->
    <div class="row mb-3">
      <div class="col">
        <label class="form-label">Arrival Time</label>
        <input type="time" name="arrival_time" class="form-control" required>
      </div>
      <div class="col">
        <label class="form-label">Departure Time</label>
        <input type="time" name="departure_time" class="form-control" required>
      </div>
    </div>

    <!-- Bus Type Dropdown -->
    <div class="mb-3">
      <label class="form-label">Bus No/Type</label>
      <div class="d-flex gap-2">
        <select name="bus_no_type" class="form-select" required>
          <option value="">Select bus type</option>
          <?php while ($b = $busTypes->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($b['name']) ?>"><?= htmlspecialchars($b['name']) ?></option>
          <?php endwhile; ?>
        </select>
        <a href="bus_types.php" class="btn btn-outline-primary">Manage</a>
      </div>
    </div>

    <!-- Optional Inputs -->
    <div class="mb-3">
      <label class="form-label">Driver Name</label>
      <input type="text" name="driver_name" class="form-control" placeholder="Optional">
    </div>

    <div class="mb-3">
      <label class="form-label">No. of Buses</label>
      <input type="number" name="no_of_bus" class="form-control" min="1" placeholder="Optional">
    </div>

    <div class="mb-3">
      <label class="form-label">Comment</label>
      <textarea name="comment" class="form-control" rows="3" placeholder="Any additional info..."></textarea>
    </div>

    <!-- Form Buttons -->
    <button class="btn btn-primary">Add Schedule</button>
    <a href="dashboard.php?day=<?= $day ?>" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
