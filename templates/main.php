<?php
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
