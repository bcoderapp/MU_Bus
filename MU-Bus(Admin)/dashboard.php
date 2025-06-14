<?php include 'includes/header.php'; include 'db.php'; ?>

<style>
  body {
    background: #f4f6fa;
  }
  .day-selector a {
    min-width: 110px;
    border-radius: 30px !important;
    font-weight: 500;
    transition: all 0.2s;
  }
  .day-selector .selected-day {
    border: 2px solid #0d6efd !important;
    background: #e9f2ff !important;
    color: #0d6efd !important;
    box-shadow: 0 2px 8px rgba(13,110,253,0.07);
  }
  .table-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #0d6efd;
    letter-spacing: 0.01em;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  .table {
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 2px 16px rgba(13,110,253,0.04);
  }
  .table thead th {
    vertical-align: middle;
    font-size: 1rem;
    letter-spacing: 0.03em;
    background: #f8fafc;
    color: #495057;
    border-bottom: 2px solid #e9ecef;
    padding-top: 1rem;
    padding-bottom: 1rem;
  }
  .table-hover tbody tr:hover {
    background: #f1f7ff;
    transition: background 0.2s;
  }
  .table tbody td {
    vertical-align: middle;
    font-size: 0.98rem;
    color: #333;
    border-top: 1px solid #f0f2f5;
    padding-top: 0.85rem;
    padding-bottom: 0.85rem;
  }
  .card {
    border-radius: 18px;
  }
  .btn-action {
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
  }
  .add-btn {
    border-radius: 30px;
    font-weight: 600;
    padding: 0.7rem 2rem;
    font-size: 1.1rem;
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
      echo "<a href='dashboard.php?day=$day' class='$btnClass'>$day</a>";
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
                    <a href='edit.php?id={$r['id']}' class='btn btn-outline-primary btn-action me-1' title='Edit'><i class='bi bi-pencil'></i></a>
                    <a href='delete.php?id={$r['id']}' onclick='return confirm(\"Are you sure?\")' class='btn btn-outline-danger btn-action' title='Delete'><i class='bi bi-trash'></i></a>
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
      <a href="add.php?day=<?= $selected_day ?>" class="btn btn-success shadow-sm add-btn">
        <i class="bi bi-plus-circle me-2"></i> Add New Schedule
      </a>
    </div>
  </div>

</div>

<?php include 'includes/footer.php'; ?>
