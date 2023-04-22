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
        <li class="nav-item">
            <a class="nav-link" href="marcket-place.php">
                <i class="fas fa-fw fa-building"></i>
                <span>Market Place</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Posts
        </div>
        <li class="nav-item">
            <a class="nav-link" href="wastage-post.php">
                <i class="fas fa-fw fa-ad"></i>
                <span>Create Post</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="my-wastage-posts.php">
                <i class="fas fa-fw fa-ad"></i>
                <span>My Posts</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Others
        </div>
        <li class="nav-item">
            <a class="nav-link" href="payments.php">
                <i class="fas fa-fw fa-dollar-sign"></i>
                <span>Payment History</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="biding.php">
                <i class="fas fa-fw fa-gavel"></i>
                <span>Biding</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="orders.php">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Orders</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
<?php } ?>