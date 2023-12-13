<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Numbers</title>
    <link rel="stylesheet" href="/axon-oop/templates/css/style.css">
</head>

<body>
    <h1>Phone Numbers</h1>
    <?php
    echo '<form action="index.php" method="get">
    <label for="country">Filter by Country:</label>
    <select name="country" id="country">
        <option value="all">All</option>';
        foreach ($db->phoneNumbers as $countryName => $codes) {
            if (!isset($categorizedNumbers[$countryName])) continue;
            echo '<option value="' . $countryName . '" ' . ($country == $countryName ? 'selected' : '') . '>' . $countryName . '</option>';
        }
        echo '</select>
    <label for="status">Filter by Status:</label>
    <select name="status" id="status">
        <option value="all">All</option>
        <option value="OK" ' . ($status == 'OK' ? 'selected' : '') . '>OK</option>
        <option value="NOK" ' . ($status == 'NOK' ? 'selected' : '') . '>NOK</option>
    </select>
    <input type="submit" value="Filter">
    </form>';
    ?>
