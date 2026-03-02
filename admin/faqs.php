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
        $stmt = $pdo->prepare("INSERT INTO faqs (question, answer) VALUES (?, ?)");
        $stmt->execute([$_POST['question'], $_POST['answer']]);
        echo "<div class='alert alert-success'>FAQ Added!</div>";
    } elseif (isset($_POST['edit'])) {
        $stmt = $pdo->prepare("UPDATE faqs SET question = ?, answer = ? WHERE id = ?");
        $stmt->execute([$_POST['question'], $_POST['answer'], $_POST['id']]);
        echo "<div class='alert alert-success'>FAQ Updated!</div>";
    } elseif (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM faqs WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        echo "<div class='alert alert-success'>FAQ Deleted!</div>";
    }
}

$faqs = $pdo->query("SELECT * FROM faqs ORDER BY id ASC")->fetchAll();
?>

<div class="row">
    <div class="col-md-12">
        <h4>Manage FAQs</h4>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="ri-add-line me-2"></i>Add New FAQ
        </button>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th width="5%">ID</th>
                    <th width="30%">Question</th>
                    <th width="45%">Answer</th>
                    <th width="20%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($faqs as $f): ?>
                    <tr>
                        <td>
                            <?php echo $f['id']; ?>
                        </td>
                        <td><strong>
                                <?php echo htmlspecialchars($f['question']); ?>
                            </strong></td>
                        <td>
                            <?php echo htmlspecialchars(substr($f['answer'], 0, 100)) . '...'; ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal<?php echo $f['id']; ?>">
                                <i class="ri-edit-line"></i> Edit
                            </button>
                            <form method="POST" style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                <input type="hidden" name="id" value="<?php echo $f['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?php echo $f['id']; ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <form method="POST" class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit FAQ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $f['id']; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Question *</label>
                                        <input type="text" name="question" class="form-control"
                                            value="<?php echo htmlspecialchars($f['question']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Answer *</label>
                                        <textarea name="answer" class="form-control" rows="5"
                                            required><?php echo htmlspecialchars($f['answer']); ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" name="edit" class="btn btn-primary">
                                        <i class="ri-save-line me-2"></i>Update FAQ
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
                <h5 class="modal-title">Add New FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Question *</label>
                    <input type="text" name="question" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Answer *</label>
                    <textarea name="answer" class="form-control" rows="5" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="add" class="btn btn-primary">
                    <i class="ri-add-line me-2"></i>Add FAQ
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'includes/footer.php'; ?>