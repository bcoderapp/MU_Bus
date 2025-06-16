<?php include '../includes/header.php'; include '../includes/sidebar.php'; include '../db.php'; ?>

<style>
body {
    background: linear-gradient(135deg, #e9f2ff 0%, #f4f6fa 100%);
    min-height: 100vh;
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
}

.container {
    width: 100%;
    max-width: calc(100vw - 260px); /* leave space for sidebar, adjust if sidebar width changes */
    margin-left: 260px; /* match sidebar width */
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
/* Table header color */
.table thead th, .table-light th {
    background-color: #2563eb !important; /* Modern blue */
    color: #fff !important;
    border-color: #e0e7ef;
}

/* Font sizes */
body {
    font-size: 1.05rem;
}
.table th, .table td {
    font-size: 1rem;
}
.table-title {
    font-size: 1.15rem;
    font-weight: 600;
}
h2 {
    font-size: 2.1rem;
}
.fs-5 {
    font-size: 1.15rem !important;
}
.btn, .btn-action, .add-btn {
    font-size: 1rem;
}
.day-selector .btn {
    font-size: 1rem;
    padding: 0.45rem 1.1rem;
}
@media (max-width: 991.98px) {
    body {
        font-size: 0.98rem;
    }
    .table th, .table td {
        font-size: 0.95rem;
    }
    h2 {
        font-size: 1.5rem;
    }
}
</style>

<?php
$selected_day = $_GET['day'] ?? 'Sunday';
?>

<div class="container py-4">

  <!-- Day Selector -->
  <div class="d-flex justify-content-center gap-2 day-selector mb-4">
    <?php
    $days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    foreach ($days as $day) {
      $btnClass = $selected_day === $day ? "btn btn-outline-primary selected-day" : "btn btn-outline-secondary";
      echo "<a href='bus_schedule.php?day=$day' class='$btnClass'>$day</a>";
    }
    ?>
  </div>

  <!-- Page Title -->
  <div class="text-center mb-4">
    <h2 class="fw-bold text-dark mb-1" style="letter-spacing:0.02em;">Bus Schedule</h2>
    <div class="text-secondary fs-5">For <span class="fw-semibold text-primary"><?= strtoupper($selected_day) ?></span></div>
  </div>

  <!-- Table Card -->
  <div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-0 pb-0">
      <div class="d-flex justify-content-between align-items-center">
        <span class="table-title"><i class="bi bi-table"></i> Schedule List</span>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Route</th>
              <th>Arrival</th>
              <th>Departure</th>
              <th>Bus No/Type</th>
              <th>Driver</th>
              <th>No. of Bus</th>
              <th>Comment</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $stmt = $conn->prepare("SELECT * FROM bus_schedule WHERE day = ?");
            $stmt->bind_param("s", $selected_day);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
              while ($r = $res->fetch_assoc()) {

                // Route & Bus Type values fetched from related tables
                $route = $conn->query("SELECT name FROM routes WHERE name = '{$r['route']}'")->fetch_assoc()['name'] ?? $r['route'];
                $busType = $conn->query("SELECT name FROM bus_types WHERE name = '{$r['bus_no_type']}'")->fetch_assoc()['name'] ?? $r['bus_no_type'];

                echo "<tr>
                  <td>{$route}</td>
                  <td>{$r['arrival_time']}</td>
                  <td>{$r['departure_time']}</td>
                  <td>{$busType}</td>
                  <td>{$r['driver_name']}</td>
                  <td>{$r['no_of_bus']}</td>
                  <td>{$r['comment']}</td>
                  <td class='text-center'>
                    <a href='bus_schedule_operations/edit.php?id={$r['id']}' class='btn btn-outline-primary btn-action me-1' title='Edit'><i class='bi bi-pencil'></i></a>
                    <a href='bus_schedule_operations/delete.php?id={$r['id']}' onclick='return confirm(\"Are you sure?\")' class='btn btn-outline-danger btn-action' title='Delete'><i class='bi bi-trash'></i></a>
                  </td>
                </tr>";
              }
            } else {
              echo "<tr><td colspan='8' class='text-center text-muted py-4'>No schedules for $selected_day.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer bg-white border-0 text-end">
      <a href="bus_schedule_operations/add.php?day=<?= $selected_day ?>" class="btn btn-success shadow-sm add-btn">
        <i class="bi bi-plus-circle me-2"></i> Add New Schedule
      </a>
    </div>
  </div>

</div>

<?php include '../includes/footer.php'; ?>
