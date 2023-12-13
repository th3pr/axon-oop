<?php

$db_path = __DIR__ . '/sample.db';
$db = new Database($db_path);

$page = $_GET['page'] ?? 1;
$numbers = $db->getNumbers($page);

$categorizedNumbers = $db->categorizeNumbers($numbers);

$country = $_GET['country'] ?? 'all';
if ($country != 'all') {
    $numbers = $categorizedNumbers[$country];
}

$status = $_GET['status'] ?? 'all';
if ($status != 'all') {
    $numbers = array_filter($numbers, function ($number) use ($db, $status) {
        return $db->validatePhoneNumber($number) === $status;
    });
}