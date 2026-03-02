<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Ensure includes directory exists
if (!is_dir(__DIR__ . '/includes')) {
    mkdir(__DIR__ . '/includes', 0777, true);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #1A3C34;
            color: white;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #D4AF37;
            color: white;
        }

        .main-content {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <div class="p-4 text-center border-bottom border-secondary">
                    <h5>HempSuccess Admin</h5>
                </div>
                <nav class="mt-4">
                    <a href="dashboard.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>"><i
                            class="ri-dashboard-line me-2"></i> Dashboard</a>
                    <a href="services.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'active' : ''; ?>"><i
                            class="ri-service-line me-2"></i> Services</a>
                    <a href="hemp_seo.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'hemp_seo.php' ? 'active' : ''; ?>"><i
                            class="ri-leaf-line me-2"></i> Hemp SEO Page</a>
                    <a href="testimonials.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'testimonials.php' ? 'active' : ''; ?>"><i
                            class="ri-chat-voice-line me-2"></i> Testimonials</a>
                    <a href="case_studies.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'case_studies.php' ? 'active' : ''; ?>"><i
                            class="ri-folder-shield-2-line me-2"></i> Case Studies</a>
                    <a href="faqs.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'faqs.php' ? 'active' : ''; ?>"><i
                            class="ri-question-line me-2"></i> FAQs</a>
                    <a href="resources.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'resources.php' ? 'active' : ''; ?>"><i
                            class="ri-book-open-line me-2"></i> Resources</a>
                    <a href="leads.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'leads.php' ? 'active' : ''; ?>"><i
                            class="ri-mail-line me-2"></i> Leads</a>
                    <a href="about.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>"><i
                            class="ri-information-line me-2"></i> About Us</a>
                    <a href="contact.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>"><i
                            class="ri-contacts-line me-2"></i> Contact Info</a>
                    <a href="popup.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'popup.php' ? 'active' : ''; ?>"><i
                            class="ri-external-link-line me-2"></i> Exit Popup</a>
                    <a href="settings.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>"><i
                            class="ri-settings-line me-2"></i> Settings</a>
                    <a href="logout.php" class="text-danger mt-5"><i class="ri-logout-box-line me-2"></i> Logout</a>
                </nav>
            </div>
            <div class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Dashboard</h2>
                    <span>Welcome,
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </span>
                </div>