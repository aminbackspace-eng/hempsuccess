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

// Handle Add/Edit/Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $stmt = $pdo->prepare("INSERT INTO case_studies (title, category, challenge, solution, image_path, metric1_value, metric1_label, metric2_value, metric2_label, metric3_value, metric3_label) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['title'], $_POST['category'], $_POST['challenge'], $_POST['solution'], $_POST['image_path'], $_POST['metric1_value'], $_POST['metric1_label'], $_POST['metric2_value'], $_POST['metric2_label'], $_POST['metric3_value'], $_POST['metric3_label']]);
        echo "<div class='alert alert-success'>Case Study Added!</div>";
    } elseif (isset($_POST['edit'])) {
        $stmt = $pdo->prepare("UPDATE case_studies SET title = ?, category = ?, challenge = ?, solution = ?, image_path = ?, metric1_value = ?, metric1_label = ?, metric2_value = ?, metric2_label = ?, metric3_value = ?, metric3_label = ? WHERE id = ?");
        $stmt->execute([$_POST['title'], $_POST['category'], $_POST['challenge'], $_POST['solution'], $_POST['image_path'], $_POST['metric1_value'], $_POST['metric1_label'], $_POST['metric2_value'], $_POST['metric2_label'], $_POST['metric3_value'], $_POST['metric3_label'], $_POST['id']]);
        echo "<div class='alert alert-success'>Case Study Updated!</div>";
    } elseif (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM case_studies WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        echo "<div class='alert alert-success'>Case Study Deleted!</div>";
    }
}

$case_studies = $pdo->query("SELECT * FROM case_studies ORDER BY id DESC")->fetchAll();
?>

<div class="row">
    <div class="col-md-12">
        <h4>Manage Case Studies</h4>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="ri-add-line me-2"></i>Add New Case Study
        </button>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th width="5%">ID</th>
                    <th width="25%">Title</th>
                    <th width="20%">Category</th>
                    <th width="30%">Key Metrics</th>
                    <th width="20%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($case_studies as $cs): ?>
                    <tr>
                        <td>
                            <?php echo $cs['id']; ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($cs['title']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($cs['category']); ?>
                        </td>
                        <td>
                            <small>
                                <strong>
                                    <?php echo htmlspecialchars($cs['metric1_label']); ?>:
                                </strong>
                                <?php echo htmlspecialchars($cs['metric1_value']); ?><br>
                                <strong>
                                    <?php echo htmlspecialchars($cs['metric2_label']); ?>:
                                </strong>
                                <?php echo htmlspecialchars($cs['metric2_value']); ?>
                            </small>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal<?php echo $cs['id']; ?>">
                                <i class="ri-edit-line"></i> Edit
                            </button>
                            <form method="POST" style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this case study?');">
                                <input type="hidden" name="id" value="<?php echo $cs['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?php echo $cs['id']; ?>" tabindex="-1">
                        <div class="modal-dialog modal-xl">
                            <form method="POST" class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Case Study</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $cs['id']; ?>">
                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label class="form-label">Title *</label>
                                            <input type="text" name="title" class="form-control"
                                                value="<?php echo htmlspecialchars($cs['title']); ?>" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Category *</label>
                                            <input type="text" name="category" class="form-control"
                                                value="<?php echo htmlspecialchars($cs['category']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Challenge *</label>
                                        <textarea name="challenge" class="form-control" rows="3"
                                            required><?php echo htmlspecialchars($cs['challenge']); ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Solution *</label>
                                        <textarea name="solution" class="form-control" rows="3"
                                            required><?php echo htmlspecialchars($cs['solution']); ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image Path</label>
                                        <input type="text" name="image_path" class="form-control"
                                            value="<?php echo htmlspecialchars($cs['image_path']); ?>">
                                    </div>
                                    <hr>
                                    <h5>Key Metrics</h5>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Metric 1 Label</label>
                                            <input type="text" name="metric1_label" class="form-control"
                                                value="<?php echo htmlspecialchars($cs['metric1_label']); ?>">
                                            <label class="form-label mt-2">Metric 1 Value</label>
                                            <input type="text" name="metric1_value" class="form-control"
                                                value="<?php echo htmlspecialchars($cs['metric1_value']); ?>">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Metric 2 Label</label>
                                            <input type="text" name="metric2_label" class="form-control"
                                                value="<?php echo htmlspecialchars($cs['metric2_label']); ?>">
                                            <label class="form-label mt-2">Metric 2 Value</label>
                                            <input type="text" name="metric2_value" class="form-control"
                                                value="<?php echo htmlspecialchars($cs['metric2_value']); ?>">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Metric 3 Label</label>
                                            <input type="text" name="metric3_label" class="form-control"
                                                value="<?php echo htmlspecialchars($cs['metric3_label']); ?>">
                                            <label class="form-label mt-2">Metric 3 Value</label>
                                            <input type="text" name="metric3_value" class="form-control"
                                                value="<?php echo htmlspecialchars($cs['metric3_value']); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" name="edit" class="btn btn-primary">
                                        <i class="ri-save-line me-2"></i>Update Case Study
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Case Study</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Category *</label>
                        <input type="text" name="category" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Challenge *</label>
                    <textarea name="challenge" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Solution *</label>
                    <textarea name="solution" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image Path</label>
                    <input type="text" name="image_path" class="form-control">
                </div>
                <hr>
                <h5>Key Metrics</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Metric 1 Label</label>
                        <input type="text" name="metric1_label" class="form-control"
                            placeholder="Organic Traffic Increase">
                        <label class="form-label mt-2">Metric 1 Value</label>
                        <input type="text" name="metric1_value" class="form-control" placeholder="385%">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Metric 2 Label</label>
                        <input type="text" name="metric2_label" class="form-control" placeholder="Keyword Rankings">
                        <label class="form-label mt-2">Metric 2 Value</label>
                        <input type="text" name="metric2_value" class="form-control" placeholder="12x">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Metric 3 Label</label>
                        <input type="text" name="metric3_label" class="form-control" placeholder="Monthly Revenue">
                        <label class="form-label mt-2">Metric 3 Value</label>
                        <input type="text" name="metric3_value" class="form-control" placeholder="$250K">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="add" class="btn btn-primary">
                    <i class="ri-add-line me-2"></i>Add Case Study
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php'; ?>