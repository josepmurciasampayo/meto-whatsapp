<?php

// Public routes
require __DIR__ . '/web/public.php';

// Admin functionality
require __DIR__ . '/web/admin.php';

// Counselor functionality
require __DIR__ . '/web/counselor.php';

// Redirects if already authenticated
require __DIR__ . '/web/unauthenticated.php';

// Any signed-in user
require __DIR__ . '/web/authenticated.php';

// Student functionality
require __DIR__ . '/web/student.php';

// Uni functionality
require __DIR__ . '/web/uni.php';
