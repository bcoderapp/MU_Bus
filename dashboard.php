<?php 
// Include header and database connection
include 'includes/header.php'; 
include 'db.php'; 
?>

<!-- Modern Background Style -->
<style>
  body {
    background: linear-gradient(135deg, #e3f0ff 0%, #f9fafe 100%);
    min-height: 100vh;
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
  }
  .card {
    background: rgba(255,255,255,0.95);
    border-radius: 1rem;
  }
  .navbar {
    border-radius: 0 0 1rem 1rem;
  }
</style>

<!-- Bootstrap Modern Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">MU Bus Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="dashboard.php">Bus Schedule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Need Analysis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Send Notification</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">

  <!-- Dashboard Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary mb-0">Bus Schedule</h2>
    <a href="add.php" class="btn btn-success shadow-sm">
      <i class="bi bi-plus-circle"></i> Add New Schedule
    </a>
  </div>

  <!-- Schedule Table Card -->
  <div class="card shadow-sm border-0">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-primary">
            <tr>
              <th>Day</th>
              <th>Route</th>
              <th>Arrival</th>
              <th>Departure</th>
              <th>Bus No/Type</th>
              <th>Driver</th>
              <th>No. of Buses</th>
              <th>Comment</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Fetch all records from bus_schedule
            $res = $conn->query("SELECT * FROM bus_schedule");
            if ($res->num_rows > 0) {
              while ($r = $res->fetch_assoc()) {
                echo "<tr>
                  <td>{$r['day']}</td>
                  <td>{$r['route']}</td>
                  <td>{$r['arrival_time']}</td>
                  <td>{$r['departure_time']}</td>
                  <td>{$r['bus_no_type']}</td>
                  <td>{$r['driver_name']}</td>
                  <td>{$r['no_of_bus']}</td>
                  <td>{$r['comment']}</td>
                  <td>
                    <a href='edit.php?id={$r['id']}' class='btn btn-sm btn-outline-primary me-1'><i class=\"bi bi-pencil\"></i></a>
                    <a href='delete.php?id={$r['id']}' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Are you sure?\")'><i class=\"bi bi-trash\"></i></a>
                  </td>
                </tr>";
              }
            } else {
              echo "<tr><td colspan='9' class='text-center text-muted'>No schedules found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<!-- Optionally include Bootstrap Icons CDN for icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<?php 
// Include footer
include 'includes/footer.php'; 
?>
