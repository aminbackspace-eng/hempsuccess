<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
require_once '../config/db.php';
include 'includes/header.php';

// Get counts
$services_count = $pdo->query("SELECT COUNT(*) FROM services")->fetchColumn();
$leads_count = $pdo->query("SELECT COUNT(*) FROM leads")->fetchColumn();
$testimonials_count = $pdo->query("SELECT COUNT(*) FROM testimonials")->fetchColumn();
$case_studies_count = $pdo->query("SELECT COUNT(*) FROM case_studies")->fetchColumn();

?>

<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <h5 class="card-title">Services</h5>
                <h2>
                    <?php echo $services_count; ?>
                </h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <h5 class="card-title">Leads</h5>
                <h2>
                    <?php echo $leads_count; ?>
                </h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark mb-4">
            <div class="card-body">
                <h5 class="card-title">Testimonials</h5>
                <h2>
                    <?php echo $testimonials_count; ?>
                </h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white mb-4">
            <div class="card-body">
                <h5 class="card-title">Case Studies</h5>
                <h2>
                    <?php echo $case_studies_count; ?>
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <h4>Recent Leads</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM leads ORDER BY created_at DESC LIMIT 5");
                while ($lead = $stmt->fetch()) {
                    echo "<tr>
                        <td>{$lead['id']}</td>
                        <td>" . htmlspecialchars($lead['full_name']) . "</td>
                        <td>" . htmlspecialchars($lead['email']) . "</td>
                        <td>" . htmlspecialchars($lead['phone']) . "</td>
                        <td>{$lead['created_at']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>