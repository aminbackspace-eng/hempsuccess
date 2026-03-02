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
        $stmt = $pdo->prepare("INSERT INTO resources (title, description, type, icon_class, link) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['title'], $_POST['description'], $_POST['type'], $_POST['icon_class'], $_POST['link']]);
        echo "<div class='alert alert-success'>Resource Added!</div>";
    } elseif (isset($_POST['edit'])) {
        $stmt = $pdo->prepare("UPDATE resources SET title = ?, description = ?, type = ?, icon_class = ?, link = ? WHERE id = ?");
        $stmt->execute([$_POST['title'], $_POST['description'], $_POST['type'], $_POST['icon_class'], $_POST['link'], $_POST['id']]);
        echo "<div class='alert alert-success'>Resource Updated!</div>";
    } elseif (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM resources WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        echo "<div class='alert alert-success'>Resource Deleted!</div>";
    }
}

$resources = $pdo->query("SELECT * FROM resources ORDER BY created_at DESC")->fetchAll();
?>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Manage Resources</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="ri-add-line me-2"></i>Add New Resource
            </button>
        </div>

        <div class="card bg-dark border-secondary">
            <div class="card-body p-0">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resources as $r): ?>
                            <tr>
                                <td><span class="badge bg-primary">
                                        <?php echo htmlspecialchars($r['type']); ?>
                                    </span></td>
                                <td>
                                    <?php echo htmlspecialchars($r['title']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars(substr($r['description'], 0, 80)) . '...'; ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal<?php echo $r['id']; ?>">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    <form method="POST" style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this resource?');">
                                        <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?php echo $r['id']; ?>" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <form method="POST" class="modal-content bg-dark text-white">
                                        <div class="modal-header border-secondary">
                                            <h5 class="modal-title">Edit Resource</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="form-label">Title *</label>
                                                    <input type="text" name="title"
                                                        class="form-control bg-secondary text-white border-0"
                                                        value="<?php echo htmlspecialchars($r['title']); ?>" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Type *</label>
                                                    <input type="text" name="type"
                                                        class="form-control bg-secondary text-white border-0"
                                                        value="<?php echo htmlspecialchars($r['type']); ?>"
                                                        placeholder="E-Book, Guide, etc." required>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description *</label>
                                                <textarea name="description"
                                                    class="form-control bg-secondary text-white border-0" rows="4"
                                                    required><?php echo htmlspecialchars($r['description']); ?></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Icon Class</label>
                                                    <input type="text" name="icon_class"
                                                        class="form-control bg-secondary text-white border-0"
                                                        value="<?php echo htmlspecialchars($r['icon_class']); ?>"
                                                        placeholder="ri-book-line">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Link</label>
                                                    <input type="text" name="link"
                                                        class="form-control bg-secondary text-white border-0"
                                                        value="<?php echo htmlspecialchars($r['link']); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-secondary">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" name="edit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" class="modal-content bg-dark text-white">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Add New Resource</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" class="form-control bg-secondary text-white border-0" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Type *</label>
                        <input type="text" name="type" class="form-control bg-secondary text-white border-0"
                            placeholder="E-Book, Guide, etc." required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-control bg-secondary text-white border-0" rows="4"
                        required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Icon Class</label>
                        <input type="text" name="icon_class" class="form-control bg-secondary text-white border-0"
                            placeholder="ri-book-line">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Link</label>
                        <input type="text" name="link" class="form-control bg-secondary text-white border-0" value="#">
                    </div>
                </div>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="add" class="btn btn-primary">Add Resource</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php'; ?>