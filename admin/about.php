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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_about'])) {
    $stmt = $pdo->prepare("INSERT INTO site_content (section_name, content_key, content_value) VALUES ('about', 'title', ?) ON DUPLICATE KEY UPDATE content_value = ?");
    $stmt->execute([$_POST['title'], $_POST['title']]);

    $stmt = $pdo->prepare("INSERT INTO site_content (section_name, content_key, content_value) VALUES ('about', 'subtitle', ?) ON DUPLICATE KEY UPDATE content_value = ?");
    $stmt->execute([$_POST['subtitle'], $_POST['subtitle']]);

    $success_message = "About section updated successfully!";
}

// Fetch current values
$about_title = 'Why Hemp SEO is Different';
$about_subtitle = 'Hemp, CBD, vape, and cannabis SEO is COMPLETELY different from normal industries. Here\'s why:';

try {
    $stmt = $pdo->prepare("SELECT content_key, content_value FROM site_content WHERE section_name = 'about'");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    if (isset($results['title']))
        $about_title = $results['title'];
    if (isset($results['subtitle']))
        $about_subtitle = $results['subtitle'];
} catch (Exception $e) {
}

?>

<div class="row">
    <div class="col-md-8">
        <h4>Manage About Section</h4>

        <?php if ($success_message): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <div class="card bg-dark border-secondary mt-3">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label text-white">Main Title</label>
                        <input type="text" name="title" class="form-control bg-secondary text-white border-0"
                            value="<?php echo htmlspecialchars($about_title); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Subtitle / Introduction</label>
                        <textarea name="subtitle" class="form-control bg-secondary text-white border-0" rows="4"
                            required><?php echo htmlspecialchars($about_subtitle); ?></textarea>
                    </div>
                    <button type="submit" name="update_about" class="btn btn-primary">Update About Section</button>
                </form>
            </div>
        </div>

        <div class="alert alert-info mt-4">
            <i class="ri-information-line me-2"></i> This updates the main heading and introductory text of the "Why Us"
            section on the homepage.
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php'; ?>