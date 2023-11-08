<?php
require __DIR__ . '/vendor/autoload.php';
$faker = Faker\Factory::create('en_PH');
// Database configuration
$dbConfig = [
    'host' => 'localhost',
    'database' => 'recordsapp_db',
    'username' => 'root',
    'password' => '10022002',
];
try {
    // Connect to the database
    $pdo = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['database']}", $dbConfig['username'], $dbConfig['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Function to generate a fake sentence
    function customFakeSentence($faker, $wordCount = 6, $separator = ' ')
    {
        $words = $faker->words($wordCount);
        return ucfirst(implode($separator, $words)) . '.';
    }
    // Insert fake data into the employee table
    for ($i = 1; $i <= 200; $i++) {
        $lastname = $faker->lastName;
        $firstname = $faker->firstName;
        $office_id = $faker->numberBetween(1, 50);
        $address = $faker->address;
        $stmt = $pdo->prepare("INSERT INTO employee (lastname, firstname, office_id, address) VALUES (?, ?, ?, ?)");
        $stmt->execute([$lastname, $firstname, $office_id, $address]);
    }
    // Insert fake data into the office table
    for ($i = 1; $i <= 50; $i++) {
        $name = $faker->company;
        $contactnum = $faker->phoneNumber;
        $email = $faker->email;
        $address = $faker->address;
        $city = $faker->city;
        $country = $faker->country;
        $postal = $faker->postcode;
        $stmt = $pdo->prepare("INSERT INTO office (name, contactnum, email, address, city, country, postal) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $contactnum, $email, $address, $city, $country, $postal]);
    }
    // Insert fake data into the transaction table
    for ($i = 1; $i <= 500; $i++) {
        $employee_id = $faker->numberBetween(1, 200);
        $office_id = $faker->numberBetween(1, 50);
        $datelog = $faker->dateTimeThisDecade('now', 'Asia/Manila')->format('Y-m-d H:i:s');
        $action = $faker->randomElement(['IN', 'OUT', 'COMPLETE']);
        $remarks = customFakeSentence($faker, 8);
        $documentcode = $faker->uuid;
        $stmt = $pdo->prepare("INSERT INTO transaction (employee_id, office_id, datelog, action, remarks, documentcode) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$employee_id, $office_id, $datelog, $action, $remarks, $documentcode]);
    }
    echo "Fake data has been successfully loaded into the database.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>