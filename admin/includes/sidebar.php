<?php if (!$utils->isWebViewDevice()) { ?>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon">
                <img src="img/logo.png" class="img" style="height: 40px !important">
            </div>
            <div class="sidebar-brand-text ml-1 mr-3">astey</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-home"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Posts
        </div>
        <li class="nav-item">
            <a class="nav-link" href="post_list.php">
                <i class="fas fa-fw fa-building"></i>
                <span>Post List</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Users
        </div>
        <li class="nav-item">
            <a class="nav-link" href="user-area.php">
                <i class="fas fa-fw fa-ad"></i>
                <span>Admin Users</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="system_users.php">
                <i class="fas fa-fw fa-ad"></i>
                <span>System Users</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="cron_job.php">
                <i class="fas fa-fw fa-ad"></i>
                <span>Cron Job</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
<?php } ?>