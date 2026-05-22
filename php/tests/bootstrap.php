<?php
/**
 * bootstrap.php - PHPUnit bootstrap file
 */

declare(strict_types=1);

if (isset($_SERVER['POSTGRES_HOST'])) {
    putenv('POSTGRES_HOST=' . $_SERVER['POSTGRES_HOST']);
}
