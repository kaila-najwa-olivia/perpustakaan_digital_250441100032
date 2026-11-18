<?php

// Correct SCRIPT_NAME and PHP_SELF so Vercel does not treat /api as the base path
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';

require __DIR__.'/../public/index.php';
