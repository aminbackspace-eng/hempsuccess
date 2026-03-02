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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_popup'])) {
    foreach (['title', 'description', 'button_text', 'is_active'] as $key) {
        $val = $_POST[$key] ?? '';
        $stmt = $pdo->prepare("INSERT INTO site_content (section_name, content_key, content_value) VALUES ('popup', ?, ?) ON DUPLICATE KEY UPDATE content_value = ?");
        $stmt->execute([$key, $val, $val]);
    }
    $success_message = "Popup settings updated successfully!";
}

// Fetch current values
$popup = [
    'title' => 'Wait! Don\'t Miss Out',
    'description' => 'Get your FREE Hemp SEO Audit and discover how to dominate Google rankings in your niche.',
    'button_text' => 'Get My Free Audit',
    'is_active' => '1'
];

try {
    $stmt = $pdo->prepare("SELECT content_key, content_value FROM site_content WHERE section_name = 'popup'");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    foreach ($popup as $key => $val) {
        if (isset($results[$key]))
            $popup[$key] = $results[$key];
    }
} catch (Exception $e) {
}

?>

<div class="row">
    <div class="col-md-8">
        <h4>Manage Exit Popup</h4>

        <?php if ($success_message): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <div class="card bg-dark border-secondary mt-3">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label text-white">Popup Status</label>
                        <select name="is_active" class="form-control bg-secondary text-white border-0">
                            <option value="1" <?php echo $popup['is_active'] == '1' ? 'selected' : ''; ?>>Active</option>
                            <option value="0" <?php echo $popup['is_active'] == '0' ? 'selected' : ''; ?>>Disabled
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Popup Title</label>
                        <input type="text" name="title" class="form-control bg-secondary text-white border-0"
                            value="<?php echo htmlspecialchars($popup['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Description</label>
                        <textarea name="description" class="form-control bg-secondary text-white border-0" rows="3"
                            required><?php echo htmlspecialchars($popup['description']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Button Text</label>
                        <input type="text" name="button_text" class="form-control bg-secondary text-white border-0"
                            value="<?php echo htmlspecialchars($popup['button_text']); ?>" required>
                    </div>
                    <button type="submit" name="update_popup" class="btn btn-primary">Save Popup Settings</button>
                </form>
            </div>
        </div>

        <div class="card bg-dark border-info mt-4">
            <div class="card-body">
                <h5 class="text-info"><i class="ri-lightbulb-line me-2"></i>How it works</h5>
                <p class="text-white/80 small mb-0">The popup appears when a user attempts to leave the page (exit
                    intent) or after they've been on the site for a while. This helps capture leads that might otherwise
                    leave without contacting you.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-dark border-secondary">
            <div class="card-header border-secondary">
                <h5 class="mb-0 text-white">Preview</h5>
            </div>
            <div class="card-body">
                <div class="bg-white rounded-lg p-4 text-dark shadow-lg">
                    <h3 class="font-serif font-bold text-primary mb-2">
                        <?php echo htmlspecialchars($popup['title']); ?>
                    </h3>
                    <p class="small text-muted mb-3">
                        <?php echo htmlspecialchars($popup['description']); ?>
                    </p>
                    <div class="bg-gray-100 h-8 mb-2 rounded border"></div>
                    <div class="bg-gray-100 h-8 mb-2 rounded border"></div>
                    <div class="bg-gray-100 h-8 mb-3 rounded border"></div>
                    <button class="btn btn-warning w-100 font-weight-bold" disabled>
                        <?php echo htmlspecialchars($popup['button_text']); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php'; ?>