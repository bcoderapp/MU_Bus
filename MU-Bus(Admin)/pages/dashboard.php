<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="d-flex" style="margin-left: 15%; min-height: 100vh; background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);">
  <!-- Main Content -->
  <div class="content p-5 w-100 container mt-5">
    <!-- <h2 class="mb-5 fw-bold text-primary" style="letter-spacing:1px;">Browse Options</h2> -->
    <div class="row g-4 justify-content-center">
      <!-- Dashboard Card -->
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="/MU-Bus(Admin)/pages/dashboard.php" class="text-decoration-none">
          <div class="card option-card shadow-sm h-100 border-0">
            <div class="card-body text-center">
              <i class="bi bi-speedometer2 display-4 mb-3 text-info"></i>
              <h5 class="card-title fw-semibold mt-4">Dashboard</h5>
              <p class="card-text text-secondary">Overview and quick stats.</p>
            </div>
          </div>
        </a>
      </div>
      <!-- Bus Schedule Card -->
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="/MU-Bus(Admin)/pages/bus_schedule.php" class="text-decoration-none">
          <div class="card option-card shadow-sm h-100 border-0">
            <div class="card-body text-center">
              <i class="bi bi-calendar2-week display-4 mb-3 text-success"></i>
              <h5 class="card-title fw-semibold mt-4">Bus Schedule</h5>
              <p class="card-text text-secondary">View and manage bus schedules.</p>
            </div>
          </div>
        </a>
      </div>
      <!-- Manage Route Card -->
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="/MU-Bus(Admin)/pages/routes.php" class="text-decoration-none">
          <div class="card option-card shadow-sm h-100 border-0">
            <div class="card-body text-center">
              <i class="bi bi-geo-alt display-4 mb-3 text-danger"></i>
              <h5 class="card-title fw-semibold mt-4">Manage Route</h5>
              <p class="card-text text-secondary">Add or edit bus routes.</p>
            </div>
          </div>
        </a>
      </div>
      <!-- Manage Bus No./Type Card -->
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="/MU-Bus(Admin)/pages/bus_types.php" class="text-decoration-none">
          <div class="card option-card shadow-sm h-100 border-0">
            <div class="card-body text-center">
              <i class="bi bi-bus-front display-4 mb-3 text-warning"></i>
              <h5 class="card-title fw-semibold mt-4">Manage Bus</h5>
              <p class="card-text text-secondary">Update bus numbers and types.</p>
            </div>
          </div>
        </a>
      </div>
      <!-- View Demand Card -->
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="/MU-Bus(Admin)/pages/demand.php" class="text-decoration-none">
          <div class="card option-card shadow-sm h-100 border-0">
            <div class="card-body text-center">
              <i class="bi bi-bar-chart-line display-4 mb-3 text-primary"></i>
              <h5 class="card-title fw-semibold mt-4">View Demand</h5>
              <p class="card-text text-secondary">Check user demand statistics.</p>
            </div>
          </div>
        </a>
      </div>
      <!-- Notify Update Card -->
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="/MU-Bus(Admin)/pages/notification.php" class="text-decoration-none">
          <div class="card option-card shadow-sm h-100 border-0">
            <div class="card-body text-center">
              <i class="bi bi-bell display-4 mb-3 text-pink"></i>
              <h5 class="card-title fw-semibold mt-4">Notify Update</h5>
              <p class="card-text text-secondary">Send notifications to users.</p>
            </div>
          </div>
        </a>
      </div>
      <!-- View as User Card -->
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="/MU-Bus(Admin)/pages/view_as.php" class="text-decoration-none">
          <div class="card option-card shadow-sm h-100 border-0">
            <div class="card-body text-center">
              <i class="bi bi-person-circle display-4 mb-3 text-secondary"></i>
              <h5 class="card-title fw-semibold mt-4">View as User</h5>
              <p class="card-text text-secondary">Preview user interface.</p>
            </div>
          </div>
        </a>
      </div>
      <!-- Developer Support Card -->
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="/MU-Bus(Admin)/pages/support.php" class="text-decoration-none">
          <div class="card option-card shadow-sm h-100 border-0">
            <div class="card-body text-center">
              <i class="bi bi-code-slash display-4 mb-3 text-success"></i>
              <h5 class="card-title fw-semibold mt-4">Developer Support</h5>
              <p class="card-text text-secondary">Get help and documentation.</p>
            </div>
          </div>
        </a>
      </div>
            <!-- Logout Card -->
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="/MU-Bus(Admin)/index.html" class="text-decoration-none">
          <div class="card option-card shadow-sm h-100 border-0">
            <div class="card-body text-center">
              <i class="bi bi-box-arrow-right display-4 mb-3 text-dark"></i>
              <h5 class="card-title fw-semibold mt-4">Logout</h5>
              <p class="card-text text-secondary">Sign out of the admin panel.</p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

<style>
/* Modern Glassmorphism Card Styles */
.option-card {
  border-top: 4px solid #6366f1;
  border-radius: 1.1rem;
  background: rgba(255,255,255,0.85);
  box-shadow: 0 4px 24px rgba(99,102,241,0.08), 0 1.5px 6px rgba(0,0,0,0.06);
  backdrop-filter: blur(6px);
  transition: 
    box-shadow 0.25s cubic-bezier(.4,0,.2,1),
    transform 0.22s cubic-bezier(.4,0,.2,1),
    border-color 0.22s cubic-bezier(.4,0,.2,1),
    background 0.22s cubic-bezier(.4,0,.2,1);
  cursor: pointer;
  position: relative;
  overflow: hidden;
  margin-bottom: 1.2rem;
  padding: 1rem 0.85rem;
}

.option-card::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(120deg, #6366f1 0%, #0ea5e9 100%);
  opacity: 0;
  transition: opacity 0.22s cubic-bezier(.4,0,.2,1);
  z-index: 0;
}

.option-card:hover {
  box-shadow: 0 8px 32px rgba(99,102,241,0.18), 0 2px 8px rgba(0,0,0,0.10)!important;
  transform: translateY(-8px) scale(1.035);
  border-top: 4px solid #0ea5e9;
  background: rgba(236, 245, 255, 0.95);
}

.option-card:hover::before {
  opacity: 0.07;
}

.option-card .card-body {
  position: relative;
  z-index: 1;
  padding: 1.3rem 0.7rem 1rem 0.7rem;
}

.option-card i {
  font-size: 2.1rem !important;
  filter: drop-shadow(0 2px 8px rgba(99,102,241,0.10));
  transition: color 0.22s, filter 0.22s;
  margin-bottom: 1rem !important;
}

.option-card:hover i {
  filter: drop-shadow(0 4px 16px rgba(99,102,241,0.18));
}

.option-card .card-title {
  letter-spacing: 0.5px;
  font-size: 1.05rem;
  margin-bottom: 0.55rem;
}

.option-card .card-text {
  font-size: 0.9rem;
  color: #64748b !important;
  margin-bottom: 0;
}

.text-pink { color: #ec4899 !important; }

/* Responsive tweaks */
@media (max-width: 576px) {
  .option-card {
    border-radius: 0.85rem;
    padding: 0.7rem 0.3rem;
    margin-bottom: 0.9rem;
  }
  .option-card .card-body {
    padding: 0.9rem 0.3rem 0.7rem 0.3rem;
  }
  .option-card i {
    font-size: 1.5rem !important;
  }
  .option-card .card-title {
    font-size: 0.98rem;
  }
  .option-card .card-text {
    font-size: 0.85rem;
  }
}
</style>

<?php include '../includes/footer.php'; ?>
