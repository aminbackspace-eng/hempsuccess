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
        $stmt = $pdo->prepare("INSERT INTO services (title, description, icon, link) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_POST['title'], $_POST['description'], $_POST['icon_class'], $_POST['link']]);
        echo "<div class='alert alert-success'>Service Added!</div>";
    } elseif (isset($_POST['edit'])) {
        $stmt = $pdo->prepare("UPDATE services SET title = ?, description = ?, icon = ?, link = ? WHERE id = ?");
        $stmt->execute([$_POST['title'], $_POST['description'], $_POST['icon_class'], $_POST['link'], $_POST['id']]);
        echo "<div class='alert alert-success'>Service Updated!</div>";
    } elseif (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        echo "<div class='alert alert-success'>Service Deleted!</div>";
    }
}

$services = $pdo->query("SELECT * FROM services ORDER BY created_at ASC")->fetchAll();
?>

<div class="row">
    <div class="col-md-12">
        <h4>Manage Services</h4>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="ri-add-line me-2"></i>Add New Service
        </button>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">Title</th>
                    <th width="40%">Description</th>
                    <th width="15%">Icon</th>
                    <th width="20%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $s): ?>
                    <tr>
                        <td><?php echo $s['id']; ?></td>
                        <td><?php echo htmlspecialchars($s['title']); ?></td>
                        <td><?php echo htmlspecialchars(substr($s['description'], 0, 100)) . '...'; ?></td>
                        <td>
                            <i class="<?php echo htmlspecialchars($s['icon']); ?> text-primary"
                                style="font-size: 24px;"></i>
                            <br><small class="text-muted"><?php echo htmlspecialchars($s['icon']); ?></small>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal<?php echo $s['id']; ?>">
                                <i class="ri-edit-line"></i> Edit
                            </button>
                            <form method="POST" style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this service?');">
                                <input type="hidden" name="id" value="<?php echo $s['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal for this service -->
                    <div class="modal fade" id="editModal<?php echo $s['id']; ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <form method="POST" class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Service</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $s['id']; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Title *</label>
                                        <input type="text" name="title" class="form-control"
                                            value="<?php echo htmlspecialchars($s['title']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description *</label>
                                        <textarea name="description" class="form-control" rows="5"
                                            required><?php echo htmlspecialchars($s['description']); ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Icon Class (RemixIcon) *</label>
                                        <input type="text" name="icon_class" class="form-control"
                                            value="<?php echo htmlspecialchars($s['icon']); ?>" placeholder="ri-search-line"
                                            required>
                                        <small class="text-muted">Visit <a href="https://remixicon.com/"
                                                target="_blank">RemixIcon</a> for icon names</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Link (optional)</label>
                                        <input type="text" name="link" class="form-control"
                                            value="<?php echo htmlspecialchars($s['link'] ?? ''); ?>"
                                            placeholder="#service-name">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" name="edit" class="btn btn-primary">
                                        <i class="ri-save-line me-2"></i>Update Service
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
                <h5 class="modal-title">Add New Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control" placeholder="Hemp & CBD SEO Services" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-control" rows="5"
                        placeholder="Detailed description of the service..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Icon Class (RemixIcon) *</label>
                    <input type="text" name="icon_class" class="form-control" placeholder="ri-search-line" required>
                    <small class="text-muted">Visit <a href="https://remixicon.com/" target="_blank">RemixIcon</a> for
                        icon names</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Link (optional)</label>
                    <input type="text" name="link" class="form-control" placeholder="#service-name">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="add" class="btn btn-primary">
                    <i class="ri-add-line me-2"></i>Add Service
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'includes/footer.php'; ?>