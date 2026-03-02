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
        $stmt = $pdo->prepare("INSERT INTO testimonials (client_name, position, company, content, rating, image_path) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['client_name'], $_POST['position'], $_POST['company'], $_POST['content'], $_POST['rating'], $_POST['image_path']]);
        echo "<div class='alert alert-success'>Testimonial Added!</div>";
    } elseif (isset($_POST['edit'])) {
        $stmt = $pdo->prepare("UPDATE testimonials SET client_name = ?, position = ?, company = ?, content = ?, rating = ?, image_path = ? WHERE id = ?");
        $stmt->execute([$_POST['client_name'], $_POST['position'], $_POST['company'], $_POST['content'], $_POST['rating'], $_POST['image_path'], $_POST['id']]);
        echo "<div class='alert alert-success'>Testimonial Updated!</div>";
    } elseif (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM testimonials WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        echo "<div class='alert alert-success'>Testimonial Deleted!</div>";
    }
}

$testimonials = $pdo->query("SELECT * FROM testimonials ORDER BY id DESC")->fetchAll();
?>

<div class="row">
    <div class="col-md-12">
        <h4>Manage Testimonials</h4>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="ri-add-line me-2"></i>Add New Testimonial
        </button>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">Client</th>
                    <th width="40%">Content</th>
                    <th width="10%">Rating</th>
                    <th width="25%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testimonials as $t): ?>
                    <tr>
                        <td>
                            <?php echo $t['id']; ?>
                        </td>
                        <td>
                            <strong>
                                <?php echo htmlspecialchars($t['client_name']); ?>
                            </strong><br>
                            <small class="text-muted">
                                <?php echo htmlspecialchars($t['position']); ?> @
                                <?php echo htmlspecialchars($t['company']); ?>
                            </small>
                        </td>
                        <td>
                            <?php echo htmlspecialchars(substr($t['content'], 0, 100)) . '...'; ?>
                        </td>
                        <td>
                            <?php echo $t['rating']; ?>/5
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal<?php echo $t['id']; ?>">
                                <i class="ri-edit-line"></i> Edit
                            </button>
                            <form method="POST" style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                <input type="hidden" name="id" value="<?php echo $t['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?php echo $t['id']; ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <form method="POST" class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Testimonial</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $t['id']; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Client Name *</label>
                                        <input type="text" name="client_name" class="form-control"
                                            value="<?php echo htmlspecialchars($t['client_name']); ?>" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Position *</label>
                                            <input type="text" name="position" class="form-control"
                                                value="<?php echo htmlspecialchars($t['position']); ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Company *</label>
                                            <input type="text" name="company" class="form-control"
                                                value="<?php echo htmlspecialchars($t['company']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Content *</label>
                                        <textarea name="content" class="form-control" rows="5"
                                            required><?php echo htmlspecialchars($t['content']); ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Rating (1-5) *</label>
                                            <input type="number" name="rating" class="form-control" min="1" max="5"
                                                value="<?php echo $t['rating']; ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Image Path</label>
                                            <input type="text" name="image_path" class="form-control"
                                                value="<?php echo htmlspecialchars($t['image_path']); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" name="edit" class="btn btn-primary">
                                        <i class="ri-save-line me-2"></i>Update Testimonial
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
    <div class="modal-dialog modal-lg">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Client Name *</label>
                    <input type="text" name="client_name" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Position *</label>
                        <input type="text" name="position" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Company *</label>
                        <input type="text" name="company" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Content *</label>
                    <textarea name="content" class="form-control" rows="5" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rating (1-5) *</label>
                        <input type="number" name="rating" class="form-control" min="1" max="5" value="5" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Image Path</label>
                        <input type="text" name="image_path" class="form-control"
                            placeholder="https://unsplash.com/...">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="add" class="btn btn-primary">
                    <i class="ri-add-line me-2"></i>Add Testimonial
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php'; ?>