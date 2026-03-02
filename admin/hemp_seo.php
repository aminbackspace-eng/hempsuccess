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

// Check if hemp_hero table has a record
$stmt = $pdo->query("SELECT id FROM hemp_hero LIMIT 1");
$hero_row = $stmt->fetch();
if (!$hero_row) {
    // Insert initial record if not exists
    $pdo->exec("INSERT INTO hemp_hero (title) VALUES ('Hemp SEO Agency')");
    $hero_id = $pdo->lastInsertId();
} else {
    $hero_id = $hero_row['id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_hero_new'])) {
    // Update basic fields
    $sql = "UPDATE hemp_hero SET 
            title = ?, 
            subtitle = ?, 
            btn1_text = ?, 
            btn1_link = ?, 
            btn2_text = ?, 
            btn2_link = ?, 
            stat1_number = ?, 
            stat1_text = ?, 
            stat2_number = ?, 
            stat2_text = ?, 
            stat3_number = ?, 
            stat3_text = ? 
            WHERE id = ?";

    $params = [
        $_POST['title'],
        $_POST['subtitle'],
        $_POST['btn1_text'],
        $_POST['btn1_link'],
        $_POST['btn2_text'],
        $_POST['btn2_link'],
        $_POST['stat1_number'],
        $_POST['stat1_text'],
        $_POST['stat2_number'],
        $_POST['stat2_text'],
        $_POST['stat3_number'],
        $_POST['stat3_text'],
        $hero_id
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    // Handle Image Upload
    if (isset($_FILES['hero_image']) && $_FILES['hero_image']['error'] == 0) {
        $target_dir = "../uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_extension = pathinfo($_FILES["hero_image"]["name"], PATHINFO_EXTENSION);
        $file_name = "hero_hemp_" . time() . "." . $file_extension;
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["hero_image"]["tmp_name"], $target_file)) {
            $stmt = $pdo->prepare("UPDATE hemp_hero SET image = ? WHERE id = ?");
            $stmt->execute([$file_name, $hero_id]);
        }
    }

    $success_message = "Hero section updated successfully!";
}

// Update Expertise Section (keeping existing functionality)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_expertise'])) {
    $stmt = $pdo->prepare("INSERT INTO site_content (section_name, content_key, content_value) VALUES ('hemp_seo', 'expertise_title', ?) ON DUPLICATE KEY UPDATE content_value = ?");
    $stmt->execute([$_POST['expertise_title'], $_POST['expertise_title']]);

    $stmt = $pdo->prepare("INSERT INTO site_content (section_name, content_key, content_value) VALUES ('hemp_seo', 'expertise_description', ?) ON DUPLICATE KEY UPDATE content_value = ?");
    $stmt->execute([$_POST['expertise_description'], $_POST['expertise_description']]);

    $success_message = "Expertise section updated successfully!";
}

// Fetch current values for hemp_hero
$stmt = $pdo->prepare("SELECT * FROM hemp_hero WHERE id = ?");
$stmt->execute([$hero_id]);
$hero = $stmt->fetch();

// Fetch current values for expertise
$expertise_title = '';
$expertise_description = '';
try {
    $stmt = $pdo->prepare("SELECT content_key, content_value FROM site_content WHERE section_name = 'hemp_seo'");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    $expertise_title = $results['expertise_title'] ?? '';
    $expertise_description = $results['expertise_description'] ?? '';
} catch (Exception $e) {
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-white">Manage Hemp SEO Hero Section</h4>
                <a href="../hemp_seo_service.php" target="_blank" class="btn btn-outline-info btn-sm">
                    <i class="ri-external-link-line me-1"></i> View Live Page
                </a>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ri-checkbox-circle-line me-2"></i> <?php echo $success_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Hero Design Form -->
            <div class="card bg-dark border-secondary mb-5 text-white shadow">
                <div class="card-header border-secondary bg-dark pt-3">
                    <h5 class="card-title"><i class="ri-layout-top-line me-2 text-warning"></i>Hero Content & Layout
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label text-secondary">Main Headline (supports &lt;br&gt;)</label>
                                <input type="text" name="title" class="form-control bg-secondary-subtle border-0 py-2"
                                    value="<?php echo htmlspecialchars($hero['title']); ?>" required>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label text-secondary">Sub-headline / Description</label>
                                <textarea name="subtitle" class="form-control bg-secondary-subtle border-0" rows="3"
                                    required><?php echo htmlspecialchars($hero['subtitle']); ?></textarea>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary">Primary Button Text</label>
                                <input type="text" name="btn1_text" class="form-control bg-secondary-subtle border-0"
                                    value="<?php echo htmlspecialchars($hero['btn1_text']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary">Primary Button Link</label>
                                <input type="text" name="btn1_link" class="form-control bg-secondary-subtle border-0"
                                    value="<?php echo htmlspecialchars($hero['btn1_link']); ?>" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary">Secondary Button Text</label>
                                <input type="text" name="btn2_text" class="form-control bg-secondary-subtle border-0"
                                    value="<?php echo htmlspecialchars($hero['btn2_text']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary">Secondary Button Link</label>
                                <input type="text" name="btn2_link" class="form-control bg-secondary-subtle border-0"
                                    value="<?php echo htmlspecialchars($hero['btn2_link']); ?>" required>
                            </div>

                            <hr class="border-secondary my-4">
                            <h6 class="mb-4 text-warning">Statistics Section</h6>

                            <div class="col-md-4 mb-4">
                                <label class="form-label text-secondary">Stat 1 Number</label>
                                <input type="text" name="stat1_number" class="form-control bg-secondary-subtle border-0"
                                    value="<?php echo htmlspecialchars($hero['stat1_number']); ?>" required>
                                <label class="form-label text-secondary mt-2">Stat 1 Text</label>
                                <input type="text" name="stat1_text" class="form-control bg-secondary-subtle border-0"
                                    value="<?php echo htmlspecialchars($hero['stat1_text']); ?>" required>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label text-secondary">Stat 2 Number</label>
                                <input type="text" name="stat2_number" class="form-control bg-secondary-subtle border-0"
                                    value="<?php echo htmlspecialchars($hero['stat2_number']); ?>" required>
                                <label class="form-label text-secondary mt-2">Stat 2 Text</label>
                                <input type="text" name="stat2_text" class="form-control bg-secondary-subtle border-0"
                                    value="<?php echo htmlspecialchars($hero['stat2_text']); ?>" required>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label text-secondary">Stat 3 Number</label>
                                <input type="text" name="stat3_number" class="form-control bg-secondary-subtle border-0"
                                    value="<?php echo htmlspecialchars($hero['stat3_number']); ?>" required>
                                <label class="form-label text-secondary mt-2">Stat 3 Text</label>
                                <input type="text" name="stat3_text" class="form-control bg-secondary-subtle border-0"
                                    value="<?php echo htmlspecialchars($hero['stat3_text']); ?>" required>
                            </div>

                            <hr class="border-secondary my-4">

                            <div class="col-md-12 mb-4">
                                <label class="form-label text-secondary">Hero Side Image</label>
                                <div class="d-flex align-items-center gap-4">
                                    <?php if ($hero['image']): ?>
                                        <?php
                                        $img_path = $hero['image'];
                                        if (!filter_var($img_path, FILTER_VALIDATE_URL)) {
                                            $img_path = '../uploads/' . $img_path;
                                        }
                                        ?>
                                        <img src="<?php echo $img_path; ?>" class="rounded"
                                            style="height: 100px; width: 140px; object-fit: cover;">
                                    <?php endif; ?>
                                    <input type="file" name="hero_image"
                                        class="form-control bg-secondary-subtle border-0">
                                </div>
                                <small class="text-muted mt-2 d-block">Recommended size: 800x600px, WebP or PNG
                                    format.</small>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" name="update_hero_new"
                                class="btn btn-warning px-5 py-2 font-weight-bold">
                                <i class="ri-save-line me-2"></i>Update Hero Section
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Expertise Section Form -->
            <div class="card bg-dark border-secondary text-white shadow mb-5">
                <div class="card-header border-secondary bg-dark pt-3">
                    <h5 class="card-title"><i class="ri-shield-star-line me-2 text-info"></i>Expertise Section</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-4">
                            <label class="form-label text-secondary">Expertise Section Title</label>
                            <input type="text" name="expertise_title" class="form-control bg-secondary-subtle border-0"
                                value="<?php echo htmlspecialchars($expertise_title); ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-secondary">Expertise Section Description</label>
                            <textarea name="expertise_description" class="form-control bg-secondary-subtle border-0"
                                rows="4" required><?php echo htmlspecialchars($expertise_description); ?></textarea>
                        </div>
                        <button type="submit" name="update_expertise" class="btn btn-info px-4 py-2">
                            <i class="ri-save-line me-2"></i>Update Expertise Section
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>