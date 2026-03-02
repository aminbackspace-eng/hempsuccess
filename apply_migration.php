<?php
require_once 'config/db.php';

try {
    $sql = file_get_contents('database/update_resources.sql');
    $pdo->exec($sql);
    echo "Database updated successfully!";
} catch (PDOException $e) {
    echo "Error updating database: " . $e->getMessage();
}
?>