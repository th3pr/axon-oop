<?php

class Database
{
    private $db;

    public function __construct($db_path)
    {
        $this->db = new SQLite3($db_path);
    }

    public function getDB()
    {
        return $this->db;
    }

    // get phone numbers from the database
    public function getNumbers($page)
    {
        $offset = ($page - 1) * 10;
        $query = "SELECT phone FROM customer";
        $query .= " LIMIT 10 OFFSET $offset";
        $results = $this->db->query($query);

        $numbers = [];
        while ($row = $results->fetchArray()) {
            $numbers[] = $row['phone'];
        }

        return $numbers;
    }

    // validate the country with the phone numbers from the database
    public $phoneNumbers = [
        'Cameroon' => ['code' => '+237', 'regex' => '/^\(237\)\ ?[2368]\d{7,8}$/'],
        'Ethiopia' => ['code' => '+251', 'regex' => '/^\(251\)\ ?[1-59]\d{8}$/'],
        'Morocco' => ['code' => '+212', 'regex' => '/^\(212\)\ ?[5-9]\d{8}$/'],
        'Mozambique' => ['code' => '+258', 'regex' => '/^\(258\)\ ?[28]\d{7,8}$/'],
        'Uganda' => ['code' => '+256', 'regex' => '/^\(256\)\ ?\d{9}$/']
    ];

    public function validateCountry($phoneNumber)
    {
        foreach ($this->phoneNumbers as $country => $codes) {
            if (preg_match($codes['regex'], $phoneNumber)) {
                return $country;
            }
        }
    }

    // validate the phone numbers from the database
    public function validatePhoneNumber($phoneNumber)
    {
        foreach ($this->phoneNumbers as $country => $codes) {
            if (preg_match($codes['regex'], $phoneNumber)) {
                return 'OK';
            }
        }
        return 'NOK';
    }

    // categorize the phone numbers by country
    public function categorizeNumbers($numbers)
    {
        $categorizedNumbers = [];
        foreach ($numbers as $number) {
            $country = $this->validateCountry($number);
            $categorizedNumbers[$country][] = $number;
        }
        return $categorizedNumbers;
    }
}
