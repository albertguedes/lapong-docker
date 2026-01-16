<?php declare(strict_types=1);

// Auth
Route::redirect('/', '/auth/login',301)->name('home');

Route::middleware('auth')->group(function () {
    // Company
    require_once __DIR__.'/company.php';

    // Contact
    require_once __DIR__.'/contact.php';

    // Customer
    require_once __DIR__.'/customer.php';

    // Dashboard
    require_once __DIR__.'/dashboard.php';

    // Medicals
    require_once __DIR__.'/medical.php';

    // Messages
    require_once __DIR__.'/messages.php';

    // News
    require_once __DIR__.'/news.php';

    // Notifications
    require_once __DIR__.'/notifications.php';

    // Pages
    require_once __DIR__.'/pages.php';

    // Posts
    require_once __DIR__.'/posts.php';

    // Scheduler
    require_once __DIR__.'/scheduler.php';
});
