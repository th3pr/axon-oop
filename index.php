<?php

include_once 'includes/db.php';

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

// Header with filters
include_once 'templates/header.php';

// Display the filtered numbers
echo '<h3>Filtered Numbers</h3>';
if (!empty($numbers)) {
    echo '<table>';
    foreach ($numbers as $number) {
        echo '<tr>';
        echo '<td>' . $number . '</td>';
        echo '<td>' . $db->validateCountry($number) . '</td>';
        echo '<td>' . ($db->validatePhoneNumber($number) == 'NOK' ? 'NOK' : 'OK') . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>No numbers found for the selected filters.</p>';
}

// Footer with pagination
include_once 'templates/footer.php';
?>
