<?php
$host = 'localhost';
$db_name = 'hassain_seo';
$username = 'root';
$password = '';

function executeSqlFile($pdo, $filePath)
{
    if (!file_exists($filePath))
        return;
    $sql = file_get_contents($filePath);
    if (!$sql)
        return;

    // Split by semicolon, but be careful about semicolons in strings (simple split for now)
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    foreach ($statements as $stmt) {
        if (!empty($stmt)) {
            try {
                $pdo->exec($stmt);
            } catch (PDOException $e) {
                // Determine if we should stop or continue. For IF NOT EXISTS, we continue.
            }
        }
    }
}

try {
    // Attempt connecting to the specific database
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
} catch (PDOException $e) {
    // If connection fails, database likely doesn't exist
    try {
        $pdo = new PDO("mysql:host=$host", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create database
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `$db_name`");

        // Create tables
        executeSqlFile($pdo, __DIR__ . '/../database/schema.sql');

    } catch (PDOException $e2) {
        die("Connection failed: " . $e2->getMessage());
    }
}

// Seeding
try {
    // Check if services table exists and is empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM services");
    if ($stmt && $stmt->fetchColumn() == 0) {
        executeSqlFile($pdo, __DIR__ . '/../database/seed_data.sql');
    }

    // Ensure admin user exists
    $stmtUser = $pdo->query("SELECT COUNT(*) FROM users");
    if ($stmtUser && $stmtUser->fetchColumn() == 0) {
        $hashedPassword = password_hash('password', PASSWORD_DEFAULT);
        $stmtInsert = $pdo->prepare("INSERT INTO users (username, password) VALUES ('admin', ?)");
        $stmtInsert->execute([$hashedPassword]);
    }
} catch (PDOException $e) {
    // Tables might not exist
}
?>