<?php 
include '../../includes/header.php';
include '../../includes/sidebar.php';
include '../../db.php';

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
  header("Location: ../bus_schedule.php?day=$day");
  exit();
}
?>

<style>
body {
  background: #f6f8fa;
  font-family: 'Segoe UI', Arial, sans-serif;
}

.modern-container {
  max-width: 50%;
  margin: 40px auto 0 auto;
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 32px rgba(60,72,88,0.10);
  padding: 40px 32px 32px 32px;
}

.modern-container h3 {
  font-size: 2rem;
  letter-spacing: 1px;
  margin-bottom: 32px;
  color: #1a237e;
  text-align: center;
}

.modern-form .form-label {
  font-weight: 600;
  color: #283593;
  margin-bottom: 8px;
}

.modern-form .form-control, 
.modern-form .form-select, 
.modern-form textarea {
  border-radius: 8px;
  border: 1px solid #c5cae9;
  padding: 10px 14px;
  font-size: 1rem;
  margin-bottom: 8px;
  background: #f3f6fb;
  transition: border-color 0.2s;
}

.modern-form .form-control:focus, 
.modern-form .form-select:focus, 
.modern-form textarea:focus {
  border-color: #536dfe;
  outline: none;
  background: #e8eaf6;
}

.modern-form .d-flex.gap-2 {
  gap: 10px;
}

.modern-form .btn-primary {
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

.modern-form .btn-primary:hover {
  background: linear-gradient(90deg, #1a237e 0%, #536dfe 100%);
}

.modern-form .btn-secondary {
  background: #e3e6fd;
  color: #1a237e;
  border: none;
  border-radius: 8px;
  padding: 10px 24px;
  font-weight: 500;
  margin-left: 8px;
}

.modern-form .btn-outline-primary {
  border: 1.5px solid #536dfe;
  color: #536dfe;
  background: #fff;
  border-radius: 8px;
  font-weight: 500;
  padding: 8px 18px;
  margin-left: 8px;
  transition: background 0.2s, color 0.2s;
}

.modern-form .btn-outline-primary:hover {
  background: #536dfe;
  color: #fff;
}

.modern-form .row {
  margin-left: -5px;
  margin-right: -5px;
}

.modern-form .col {
  padding-left: 5px;
  padding-right: 5px;
}

@media (max-width: 600px) {
  .modern-container {
    padding: 18px 6px 18px 6px;
  }
  .modern-container h3 {
    font-size: 1.2rem;
  }
}
</style>

<div class="modern-container">
  <h3 class="fw-bold mb-4">+ Add New Schedule for <?= strtoupper($day) ?></h3>
  
  <form method="POST" class="modern-form">

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
    <a href="../bus_schedule.php?day=<?= $day ?>" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<?php include '../../includes/footer.php'; ?>
