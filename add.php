<?php include 'db.php'; include 'includes/header.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize inputs
  $day = $_POST['day'];
  $route = $_POST['route'];
  $arrival = $_POST['arrival_time'];
  $departure = $_POST['departure_time'];
  $bus_no = $_POST['bus_no_type'];
  $driver = $_POST['driver_name'];
  $count = intval($_POST['no_of_bus']);
  $comment = $_POST['comment'];

  $stmt = $conn->prepare("INSERT INTO bus_schedule 
    (day,route,arrival_time,departure_time,bus_no_type,driver_name,no_of_bus,comment)
    VALUES (?,?,?,?,?,?,?,?)");
  $stmt->bind_param("ssssssis", $day,$route,$arrival,$departure,$bus_no,$driver,$count,$comment);
  $stmt->execute();
  header("Location: index.php");
}
?>

<form method="POST" class="p-4 bg-light rounded">
  <!-- Day dropdown -->
  <div class="mb-3">
    <label>Day</label>
    <select name="day" class="form-select" required>
      <option value="">Select Day</option>
      <?php foreach(["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"] as $d)
        echo "<option>$d</option>"; ?>
    </select>
  </div>

  <!-- Route with tag autocomplete -->
  <div class="mb-3">
    <label>Route</label>
    <input type="text" name="route" class="form-control tag-input" placeholder="Start typing route...">
  </div>

  <!-- Arrival & Departure -->
  <div class="row mb-3">
    <div class="col">
      <label>Arrival Time</label>
      <input type="time" name="arrival_time" class="form-control" required>
    </div>
    <div class="col">
      <label>Departure Time</label>
      <input type="time" name="departure_time" class="form-control" required>
    </div>
  </div>

  <!-- Other fields -->
  <div class="mb-3">
    <label>Bus No/Type</label>
    <input type="text" name="bus_no_type" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Driver Name</label>
    <input type="text" name="driver_name" class="form-control">
  </div>
  <div class="mb-3">
    <label>No. of Buses</label>
    <input type="number" name="no_of_bus" class="form-control">
  </div>
  <div class="mb-3">
    <label>Comment</label>
    <textarea name="comment" class="form-control"></textarea>
  </div>

  <button class="btn btn-primary">Add Schedule</button>
  <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include 'includes/footer.php'; ?>
