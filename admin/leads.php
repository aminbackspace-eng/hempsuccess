<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
require_once '../config/db.php';
include 'includes/header.php';

$leads = $pdo->query("SELECT * FROM leads ORDER BY created_at DESC")->fetchAll();
?>

<h3>Leads</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Website</th>
            <th>Business Type</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($leads as $l): ?>
            <tr>
                <td>
                    <?php echo htmlspecialchars($l['full_name']); ?>
                </td>
                <td><a href="mailto:<?php echo htmlspecialchars($l['email']); ?>">
                        <?php echo htmlspecialchars($l['email']); ?>
                    </a></td>
                <td>
                    <?php echo htmlspecialchars($l['phone']); ?>
                </td>
                <td><a href="<?php echo htmlspecialchars($l['website_url']); ?>" target="_blank">
                        <?php echo htmlspecialchars($l['website_url']); ?>
                    </a></td>
                <td>
                    <?php echo htmlspecialchars($l['business_type']); ?>
                </td>
                <td>
                    <?php echo $l['created_at']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>