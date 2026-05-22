<?php

declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

final class DatabaseTest extends TestCase
{
    private string $host;
    private string $port;
    private string $dbname;
    private string $user;
    private string $password;

    protected function setUp(): void
    {
        $this->host = getenv('POSTGRES_HOST') ?: '127.0.0.1';
        $this->port = getenv('POSTGRES_PORT') ?: '5432';
        $this->dbname = getenv('POSTGRES_DB') ?: 'lapongdb';
        $this->user = getenv('POSTGRES_USER') ?: 'lapong';
        $this->password = getenv('POSTGRES_PASSWORD') ?: 'lapong';
    }

    #[Test]
    public function canConnectToDatabase(): void
    {
        $dsn = sprintf(
            'host=%s port=%s dbname=%s user=%s password=%s',
            $this->host,
            $this->port,
            $this->dbname,
            $this->user,
            $this->password
        );

        $conn = @pg_connect($dsn);
        if ($conn === false) {
            $this->markTestSkipped('Database connection failed to host: ' . $this->host);
        }
        $this->assertNotFalse($conn);
        pg_close($conn);
    }

    #[Test]
    public function canRunSimpleQuery(): void
    {
        $dsn = sprintf(
            'host=%s port=%s dbname=%s user=%s password=%s',
            $this->host,
            $this->port,
            $this->dbname,
            $this->user,
            $this->password
        );

        $conn = @pg_connect($dsn);
        if ($conn === false) {
            $this->markTestSkipped('Database connection failed');
        }

        $result = pg_query($conn, 'SELECT version()');
        $this->assertNotFalse($result);

        $row = pg_fetch_assoc($result);
        $this->assertIsArray($row);
        $this->assertStringContainsString('PostgreSQL', $row['version']);

        pg_close($conn);
    }

    #[Test]
    public function canGetDatabaseSize(): void
    {
        $dsn = sprintf(
            'host=%s port=%s dbname=%s user=%s password=%s',
            $this->host,
            $this->port,
            $this->dbname,
            $this->user,
            $this->password
        );

        $conn = @pg_connect($dsn);
        if ($conn === false) {
            $this->markTestSkipped('Database connection failed');
        }

        $result = pg_query($conn, "SELECT pg_database_size('lapongdb')");
        $this->assertNotFalse($result);

        $size = pg_fetch_result($result, 0, 0);
        $this->assertIsNumeric($size);
        $this->assertGreaterThanOrEqual(0, $size);

        pg_close($conn);
    }
}
