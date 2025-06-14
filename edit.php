<?php
include 'db.php';
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM bus_schedule WHERE id = $id");
$row = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $day = $_POST['day'];
  $route = $_POST['route'];
  $arrival = $_POST['arrival_time'];
  $departure = $_POST['departure_time'];
  $bus_no = $_POST['bus_no_type'];
  $driver = $_POST['driver_name'];
  $count = intval($_POST['no_of_bus']);
  $comment = $_POST['comment'];

  $stmt = $conn->prepare("UPDATE bus_schedule SET day=?, route=?, arrival_time=?, departure_time=?, bus_no_type=?, driver_name=?, no_of_bus=?, comment=? WHERE id=?");
  $stmt->bind_param("ssssssisi", $day,$route,$arrival,$departure,$bus_no,$driver,$count,$comment,$id);
  $stmt->execute();
  header("Location: index.php");
}
?>
<?php include 'includes/header.php'; ?>
<form method="POST" class="p-4 bg-light rounded">
  <!-- same form fields as add.php -->
  <div class="mb-3">
    <label>Day</label>
    <select name="day" class="form-select" required>
      <option value="">Select Day</option>
      <?php
      $days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
      foreach ($days as $d) {
        $sel = $row['day'] == $d ? "selected" : "";
        echo "<option $sel>$d</option>";
      }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label>Route</label>
    <input type="text" name="route" class="form-control" value="<?= $row['route'] ?>">
  </div>
  <div class="row mb-3">
    <div class="col">
      <label>Arrival Time</label>
      <input type="time" name="arrival_time" class="form-control" value="<?= $row['arrival_time'] ?>">
    </div>
    <div class="col">
      <label>Departure Time</label>
      <input type="time" name="departure_time" class="form-control" value="<?= $row['departure_time'] ?>">
    </div>
  </div>
  <div class="mb-3">
    <label>Bus No/Type</label>
    <input type="text" name="bus_no_type" class="form-control" value="<?= $row['bus_no_type'] ?>">
  </div>
  <div class="mb-3">
    <label>Driver Name</label>
    <input type="text" name="driver_name" class="form-control" value="<?= $row['driver_name'] ?>">
  </div>
  <div class="mb-3">
    <label>No. of Buses</label>
    <input type="number" name="no_of_bus" class="form-control" value="<?= $row['no_of_bus'] ?>">
  </div>
  <div class="mb-3">
    <label>Comment</label>
    <textarea name="comment" class="form-control"><?= $row['comment'] ?></textarea>
  </div>
  <button class="btn btn-primary">Update Schedule</button>
  <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>
<?php include 'includes/footer.php'; ?>