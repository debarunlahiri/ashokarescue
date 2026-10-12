<?php
/**
 * Admin Header Include
 * Common header for all admin pages
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Admin - Ashoka Rescue
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 100;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            transition: all 0.3s;
            border-radius: 8px;
            margin: 4px 0;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
    <?php if (isset($additionalStyles)): ?>
        <?php echo $additionalStyles; ?>
    <?php endif; ?>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="p-4">
            <h4 class="mb-4"><i class="fas fa-heartbeat"></i> Ashoka Rescue</h4>
            <p class="small mb-0">Welcome,</p>
            <p class="fw-bold">
                <?php echo htmlspecialchars($_SESSION['admin_name']); ?>
            </p>
        </div>
        <nav class="nav flex-column px-3">
            <a class="nav-link <?php echo isset($activePage) && $activePage === 'dashboard' ? 'active' : ''; ?>"
                href="dashboard.php">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a class="nav-link <?php echo isset($activePage) && $activePage === 'services' ? 'active' : ''; ?>"
                href="services.php">
                <i class="fas fa-ambulance"></i> Services
            </a>
            <a class="nav-link <?php echo isset($activePage) && $activePage === 'testimonials' ? 'active' : ''; ?>"
                href="testimonials.php">
                <i class="fas fa-star"></i> Testimonials
            </a>
            <a class="nav-link <?php echo isset($activePage) && $activePage === 'stories' ? 'active' : ''; ?>"
                href="stories.php">
                <i class="fas fa-book"></i> Our Stories
            </a>
            <a class="nav-link <?php echo isset($activePage) && $activePage === 'quotes' ? 'active' : ''; ?>"
                href="quotes.php">
                <i class="fas fa-envelope"></i> Quotes
            </a>
            <hr style="border-color: rgba(255, 255, 255, 0.2);">
            <a class="nav-link" href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">