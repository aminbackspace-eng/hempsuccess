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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_contact'])) {
    foreach (['email', 'phone', 'address'] as $key) {
        $stmt = $pdo->prepare("INSERT INTO site_content (section_name, content_key, content_value) VALUES ('contact', ?, ?) ON DUPLICATE KEY UPDATE content_value = ?");
        $stmt->execute([$key, $_POST[$key], $_POST[$key]]);
    }
    $success_message = "Contact information updated successfully!";
}

// Fetch current values
$contact = [
    'email' => 'info@hempsuccess.com',
    'phone' => '(555) 123-4567',
    'address' => '123 Hemp Street, Denver, CO 80202'
];

try {
    $stmt = $pdo->prepare("SELECT content_key, content_value FROM site_content WHERE section_name = 'contact'");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    foreach ($contact as $key => $val) {
        if (isset($results[$key]))
            $contact[$key] = $results[$key];
    }
} catch (Exception $e) {
}

?>

<div class="row">
    <div class="col-md-8">
        <h4>Manage Contact Information</h4>

        <?php if ($success_message): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <div class="card bg-dark border-secondary mt-3">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label text-white">Email Address</label>
                        <input type="email" name="email" class="form-control bg-secondary text-white border-0"
                            value="<?php echo htmlspecialchars($contact['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Phone Number</label>
                        <input type="text" name="phone" class="form-control bg-secondary text-white border-0"
                            value="<?php echo htmlspecialchars($contact['phone']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Physical Address</label>
                        <textarea name="address" class="form-control bg-secondary text-white border-0" rows="3"
                            required><?php echo htmlspecialchars($contact['address']); ?></textarea>
                    </div>
                    <button type="submit" name="update_contact" class="btn btn-primary">Update Contact Info</button>
                    <a href="leads.php" class="btn btn-outline-info ms-2">View Incoming Leads</a>
                </form>
            </div>
        </div>

        <div class="alert alert-info mt-4">
            <i class="ri-information-line me-2"></i> This updates the contact details shown in the website footer.
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php'; ?>