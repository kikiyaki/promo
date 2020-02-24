<?php

/**
 * Make database migration
 */

require_once __DIR__ . '/lib/MyPDO.php';

$pdo = new promo\MyPDO();

$migrationFiles = glob(__DIR__ . '/migrations/*.sql');
foreach ($migrationFiles as $migrationFile) {
    $fileName = basename($migrationFile);
    $query = file_get_contents($migrationFile);
    try {
        $pdo->exec($query);
        echo "Migration completed: $fileName";
    } catch (Throwable $e) {
        echo "Error migration: $fileName \n";
    }
}