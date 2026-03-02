<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
require_once '../config/db.php';
include 'includes/header.php';

$success_message = '';
$error_message = '';

// Handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Get current user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (password_verify($current_password, $user['password'])) {
        if ($new_password === $confirm_password) {
            if (strlen($new_password) >= 6) {
                $hashed = password_hash($new_password, PASSWORD_DEFAULT);
                $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
                $update->execute([$hashed, $_SESSION['user_id']]);
                $success_message = "Password changed successfully!";
            } else {
                $error_message = "New password must be at least 6 characters long.";
            }
        } else {
            $error_message = "New passwords do not match.";
        }
    } else {
        $error_message = "Current password is incorrect.";
    }
}

// Handle username change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_username'])) {
    $new_username = trim($_POST['new_username']);

    if (!empty($new_username)) {
        // Check if username already exists
        $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? AND id != ?");
        $check->execute([$new_username, $_SESSION['user_id']]);

        if ($check->fetchColumn() == 0) {
            $update = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
            $update->execute([$new_username, $_SESSION['user_id']]);
            $_SESSION['username'] = $new_username;
            $success_message = "Username changed successfully!";
        } else {
            $error_message = "Username already exists.";
        }
    } else {
        $error_message = "Username cannot be empty.";
    }
}

// Get current user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$current_user = $stmt->fetch();
?>

<div class="row">
    <div class="col-md-8">
        <h3>Settings</h3>

        <?php if ($success_message): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php echo htmlspecialchars($success_message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?php echo htmlspecialchars($error_message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Account Information -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Account Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Current Username:</strong>
                    <?php echo htmlspecialchars($current_user['username']); ?>
                </p>
                <p><strong>Account Created:</strong>
                    <?php echo date('F j, Y', strtotime($current_user['created_at'])); ?>
                </p>
            </div>
        </div>

        <!-- Change Username -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Change Username</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">New Username</label>
                        <input type="text" name="new_username" class="form-control"
                            value="<?php echo htmlspecialchars($current_user['username']); ?>" required>
                    </div>
                    <button type="submit" name="change_username" class="btn btn-primary">Update Username</button>
                </form>
            </div>
        </div>

        <!-- Change Password -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Change Password</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                        <small class="text-muted">Minimum 6 characters</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>

        <!-- Database Statistics -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Database Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Total Services:</strong>
                            <?php echo $pdo->query("SELECT COUNT(*) FROM services")->fetchColumn(); ?>
                        </p>
                        <p><strong>Total Leads:</strong>
                            <?php echo $pdo->query("SELECT COUNT(*) FROM leads")->fetchColumn(); ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Total Testimonials:</strong>
                            <?php echo $pdo->query("SELECT COUNT(*) FROM testimonials")->fetchColumn(); ?>
                        </p>
                        <p><strong>Total Case Studies:</strong>
                            <?php echo $pdo->query("SELECT COUNT(*) FROM case_studies")->fetchColumn(); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">System Information</h5>
            </div>
            <div class="card-body">
                <p><strong>PHP Version:</strong>
                    <?php echo phpversion(); ?>
                </p>
                <p><strong>Database:</strong> MySQL (
                    <?php echo $pdo->getAttribute(PDO::ATTR_SERVER_VERSION); ?>)
                </p>
                <p><strong>Server:</strong>
                    <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?>
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <a href="dashboard.php" class="btn btn-outline-primary w-100 mb-2">
                    <i class="ri-dashboard-line me-2"></i>Dashboard
                </a>
                <a href="services.php" class="btn btn-outline-primary w-100 mb-2">
                    <i class="ri-service-line me-2"></i>Manage Services
                </a>
                <a href="leads.php" class="btn btn-outline-primary w-100 mb-2">
                    <i class="ri-mail-line me-2"></i>View Leads
                </a>
                <a href="../index.php" target="_blank" class="btn btn-outline-success w-100 mb-2">
                    <i class="ri-external-link-line me-2"></i>View Website
                </a>
                <a href="logout.php" class="btn btn-outline-danger w-100">
                    <i class="ri-logout-box-line me-2"></i>Logout
                </a>
            </div>
        </div>

        <!-- Help & Support -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Help & Support</h5>
            </div>
            <div class="card-body">
                <p class="small text-muted">Need help? Contact your system administrator or refer to the documentation.
                </p>
                <p class="small"><strong>Default Credentials:</strong></p>
                <p class="small mb-0">Username: admin<br>Password: password</p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>