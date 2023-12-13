<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Numbers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
        }

        select,
        input {
            padding: 8px;
            margin-right: 10px;
        }

        .pagination {
            padding: 8px;
            margin-right: 5px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: black;
            border-radius: 4px;
        }

        .pagination:hover {
            background-color: #ddd;
        }
    </style>
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
