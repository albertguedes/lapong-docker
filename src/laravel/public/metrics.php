<?php

declare(strict_types=1);

$dbSize = 0;
$dbConnections = 0;

try {
    $pdo = new PDO(
        'pgsql:host=' . getenv('POSTGRES_HOST') . ';port=' . getenv('POSTGRES_PORT'),
        getenv('POSTGRES_USER') ?: 'lapong',
        getenv('POSTGRES_PASSWORD') ?: 'lapong'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sizeResult = $pdo->query("SELECT pg_database_size(current_database())");
    $dbSize = (int) $sizeResult->fetchColumn();

    $connResult = $pdo->query("SELECT count(*) FROM pg_stat_activity");
    $dbConnections = (int) $connResult->fetchColumn();
} catch (PDOException $e) {
}

header('Content-Type: application/json');
echo json_encode([
    'status' => 'ok',
    'timestamp' => date('c'),
    'database' => [
        'size_bytes' => $dbSize,
        'size_human' => $dbSize > 0 ? number_format($dbSize / 1024 / 1024, 2) . ' MB' : 'N/A',
        'connections' => $dbConnections,
    ],
    'php' => [
        'version' => PHP_VERSION,
        'memory_usage' => memory_get_usage(true),
        'peak_memory' => memory_get_peak_usage(true),
    ],
], JSON_PRETTY_PRINT);
