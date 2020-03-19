<?php

/**
 * Make database migration after successful database connection
 */

require_once __DIR__ . '/lib/MyPDO.php';

$secondsTimeout = 60;

$startTime = time();
$endTime = $startTime + $secondsTimeout;

while (time() < $endTime) {
    try {
        migrate();
        break;
    } catch (Exception $e) {
    }
}

function migrate()
{
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
}