<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Map both possible variable names
    $full_name = $_POST['name'] ?? $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $website_url = $_POST['url'] ?? $_POST['website_url'] ?? '';
    $business_type = $_POST['business_type'] ?? '';
    $traffic = $_POST['traffic'] ?? '';
    $challenge = $_POST['challenge'] ?? '';

    try {
        $stmt = $pdo->prepare("INSERT INTO leads (full_name, email, phone, website_url, business_type, traffic, challenge) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$full_name, $email, $phone, $website_url, $business_type, $traffic, $challenge]);

        // Redirect with success message
        header("Location: services.php?status=success#audit");
        exit;
    } catch (PDOException $e) {
        header("Location: services.php?status=error&message=" . urlencode($e->getMessage()) . "#audit");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>