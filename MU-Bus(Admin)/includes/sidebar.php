<div class="d-flex">
    <div class="sidebar text-white p-3 shadow-lg"
        style="height: 100vh; position: fixed; width: 15%; background: linear-gradient(135deg, #1abc9c 0%, #34495e 100%); box-shadow: 0 8px 32px rgba(31,38,135,0.18);">
        <div class="sidebar-logo mt-5 mb-4 d-flex align-items-center justify-content-center">
            <!-- <span class="sidebar-logo-icon d-flex align-items-center justify-content-center me-2" style="width:48px;height:48px;background:#fff2;border-radius:50%;box-shadow:0 2px 8px rgba(13,110,253,0.15);">
                <i class="bi bi-bus-front fs-3" style="color:#fff;"></i>
            </span> -->
            <h3 class="fw-bold mb-3">MU-Bus(Admin)</h3>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php')
                    echo 'active'; ?>"
                    href="/MU-Bus(Admin)/pages/dashboard.php">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'bus_schedule.php')
                    echo 'active'; ?>"
                    href="/MU-Bus(Admin)/pages/bus_schedule.php">
                    <i class="bi bi-calendar2-week me-2"></i> Bus Schedule
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'routes.php')
                    echo 'active'; ?>"
                    href="/MU-Bus(Admin)/pages/routes.php">
                    <i class="bi bi-geo-alt me-2"></i> Manage Route
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'bus_types.php')
                    echo 'active'; ?>"
                    href="/MU-Bus(Admin)/pages/bus_types.php">
                    <i class="bi bi-bus-front me-2"></i> Manage Bus
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'demand.php' && $_SERVER['REQUEST_URI'] == '/MU-Bus(Admin)/pages/demand.php?view=demand')
                    echo 'active'; ?>"
                    href="/MU-Bus(Admin)/pages/demand.php?view=demand">
                    <i class="bi bi-bar-chart-line me-2"></i> View Demand
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'notification.php' && $_SERVER['REQUEST_URI'] == '/MU-Bus(Admin)/pages/notification.php?view=notify')
                    echo 'active'; ?>"
                    href="/MU-Bus(Admin)/pages/notification.php?view=notify">
                    <i class="bi bi-bell me-2"></i> Notify Update
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'view_as.php' && $_SERVER['REQUEST_URI'] == '/MU-Bus(Admin)/pages/view_as.php?view=user')
                    echo 'active'; ?>"
                    href="/MU-Bus(Admin)/pages/view_as.php?view=user">
                    <i class="bi bi-person-circle me-2"></i> View as User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == 'support.php' && $_SERVER['REQUEST_URI'] == '/MU-Bus(Admin)/pages/support.php?view=dev')
                    echo 'active'; ?>"
                    href="/MU-Bus(Admin)/pages/support.php?view=dev">
                    <i class="bi bi-code-slash me-2"></i> Developer Support
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link sidebar-link" href="/MU-Bus(Admin)/index.html">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>
<style>
    .sidebar {
        transition: box-shadow 0.3s, background 0.3s;
        background: linear-gradient(135deg, #0d6efd 0%, #6f42c1 100%) !important;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.18);
        min-width: 260px;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }

    .sidebar-logo h4 {
        color: #fff;
        text-shadow: 0 2px 8px rgba(13, 110, 253, 0.15);
        font-size: 1.5rem;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
        color: #fff !important;
        background: rgba(255, 255, 255, 0.04);
        border: none;
        border-radius: 999px;
        padding: 0.65rem 1.2rem;
        margin-bottom: 0.2rem;
        transition: background 0.18s, color 0.18s, box-shadow 0.18s, transform 0.18s;
        box-shadow: none;
        position: relative;
        letter-spacing: 0.02em;
    }

    .sidebar-link:hover {
        background: linear-gradient(90deg, #6f42c1 60%, rgb(11, 85, 198) 100%);
        color: #fff !important;
        box-shadow: 0 2px 12px rgba(31, 38, 135, 0.22);
        text-decoration: none;
        transform: translateY(-2px) scale(1.03);
    }

    .sidebar .nav-link.active {
        color: rgb(65, 37, 228) !important;
        background: rgb(247, 244, 255) !important;
        font-weight: 700;
        box-shadow: 0 4px 16px rgba(31, 38, 135, 0.25);
        border: 2px solid #fff3;
        transform: scale(1.04);
    }

    .sidebar .nav-link i {
        font-size: 1.2rem;
        opacity: 0.92;
    }

    .sidebar .nav-link.active i {
        color: rgb(65, 37, 228) !important;
        text-shadow: 0 1px 4px rgba(13, 110, 253, 0.12);
    }

    .sidebar .nav-link:focus-visible {
        outline: 2px solid #6f42c1;
        box-shadow: 0 0 0 4px rgba(111, 66, 193, 0.15);
    }

    @media (max-width: 991px) {
        .sidebar {
            width: 100vw;
            min-width: unset;
            border-radius: 0 0 24px 24px;
            height: auto;
            position: relative;
        }
    }
</style>